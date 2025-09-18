import {inject, intercept} from '@loopback/core';
import {
  get,
  post,
  put,
  del,
  param,
  requestBody,
  response,
  RestBindings,
  Request,
} from '@loopback/rest';
import {CrawlJobsRepository, LeadSourcesRepository} from '../repositories';
import {v4 as uuidv4} from 'uuid';

/**
 * Crawl Jobs Controller
 * Manages scraping job creation and lifecycle
 */
export class CrawlJobsController {
  constructor(
    @inject('repositories.CrawlJobsRepository')
    public crawlJobsRepository: CrawlJobsRepository,
    @inject('repositories.LeadSourcesRepository')
    public leadSourcesRepository: LeadSourcesRepository,
    @inject(RestBindings.Http.REQUEST)
    public request: Request,
  ) {}

  /**
   * Get all crawl jobs for the authenticated user
   * GET /crawl-jobs
   */
  @get('/crawl-jobs')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'List of crawl jobs',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            data: {
              type: 'array',
              items: {
                type: 'object',
                properties: {
                  id: {type: 'number'},
                  source_id: {type: 'number'},
                  status: {type: 'string'},
                  notes: {type: 'string'},
                  created_by: {type: 'number'},
                  created_at: {type: 'string'},
                  updated_at: {type: 'string'},
                },
              },
            },
          },
        },
      },
    },
  })
  async getCrawlJobs() {
    try {
      const user = (this.request as any).user;
      if (!user) {
        return {
          success: false,
          message: 'User not authenticated',
          data: [],
        };
      }

      const crawlJobs = await this.crawlJobsRepository.find({
        where: {user_id: user.id},
        order: ['start_time DESC'],
      });

      // Parse the params field
      const jobsWithParsedData = crawlJobs.map(job => {
        let parsedParams: any = {};
        try {
          // Handle both string and object params
          if (typeof job.params === 'string') {
            parsedParams = JSON.parse(job.params);
          } else if (typeof job.params === 'object' && job.params !== null) {
            parsedParams = job.params;
          } else {
            parsedParams = {};
          }
        } catch (error) {
          console.warn(`Failed to parse params for job ${job.job_id}:`, error);
          parsedParams = {};
        }

        return {
          ...job,
          params: parsedParams,
        };
      });

      return {
        success: true,
        message: 'Crawl jobs retrieved successfully',
        data: jobsWithParsedData,
      };
    } catch (error) {
      console.error('Error fetching crawl jobs:', error);
      return {
        success: false,
        message: 'Failed to fetch crawl jobs',
        data: [],
      };
    }
  }

  /**
   * Create a new crawl job
   * POST /crawl-jobs
   */
  @post('/crawl-jobs')
  @intercept('interceptor.auth')
  @response(201, {
    description: 'Crawl job created successfully',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            data: {
              type: 'object',
              properties: {
                id: {type: 'number'},
                source_id: {type: 'number'},
                status: {type: 'string'},
                name: {type: 'string'},
                params: {type: 'object'},
                created_by: {type: 'number'},
                created_at: {type: 'string'},
                updated_at: {type: 'string'},
              },
            },
          },
        },
      },
    },
  })
  async createCrawlJob(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            required: ['source_id', 'title', 'params'],
            properties: {
              source_id: {type: 'number'},
              title: {type: 'string'},
              params: {type: 'object'},
              description: {type: 'string'},
            },
          },
        },
      },
    })
    jobData: {
      source_id: number;
      title: string;
      params: any;
      description?: string;
    },
  ) {
    try {
      const user = (this.request as any).user;
      if (!user) {
        return {
          success: false,
          message: 'User not authenticated',
          data: null,
        };
      }

      // Validate that the lead source exists
      const leadSource = await this.leadSourcesRepository.findById(jobData.source_id);
      if (!leadSource) {
        return {
          success: false,
          message: 'Lead source not found',
          data: null,
        };
      }

      // Validate job parameters against the lead source schema
      const validationResult = await this.validateJobParameters(
        jobData.source_id,
        jobData.params,
      );

      if (!validationResult.valid) {
        return {
          success: false,
          message: `Invalid parameters: ${validationResult.errors.join(', ')}`,
          data: null,
        };
      }

      // Check rate limits
      const rateLimitCheck = await this.checkRateLimits(user.account_id);
      if (!rateLimitCheck.allowed) {
        return {
          success: false,
          message: `Rate limit exceeded. ${rateLimitCheck.message}`,
          data: null,
        };
      }

      // Generate UUID for job_id
      const jobId = uuidv4();

      // Create the crawl job
      const newJob = await this.crawlJobsRepository.create({
        job_id: jobId,
        account_id: parseInt(user.account_id),
        user_id: user.id,
        lead_source_id: jobData.source_id,
        params: JSON.stringify(jobData.params),
        status: 'pending',
        title: jobData.title,
        description: jobData.description || undefined,
      });

      return {
        success: true,
        message: 'Crawl job created successfully',
        data: {
          ...newJob,
          params: jobData.params,
        },
      };
    } catch (error) {
      console.error('Error creating crawl job:', error);
      return {
        success: false,
        message: 'Failed to create crawl job',
        data: null,
      };
    }
  }

  /**
   * Update a crawl job status
   * PUT /crawl-jobs/{id}
   */
  @put('/crawl-jobs/{id}')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Crawl job updated successfully',
  })
  async updateCrawlJob(
    @param.path.string('id') id: string,
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            properties: {
              status: {type: 'string'},
              start_time: {type: 'string'},
              end_time: {type: 'string'},
              records_scrapped: {type: 'number'},
              description: {type: 'string'},
              title: {type: 'string'},
            },
          },
        },
      },
    })
    updates: {
      status?: string;
      start_time?: string;
      end_time?: string;
      records_scrapped?: number;
      description?: string;
      title?: string;
    },
  ) {
    try {
      // Validate UUID format
      const uuidRegex = /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i;
      if (!uuidRegex.test(id)) {
        return {
          success: false,
          message: 'Invalid job ID format. Please provide a valid UUID.',
          data: null,
        };
      }
      const user = (this.request as any).user;
      if (!user) {
        return {
          success: false,
          message: 'User not authenticated',
          data: null,
        };
      }

      const existingJob = await this.crawlJobsRepository.findOne({
        where: {job_id: id}
      });
      if (!existingJob) {
        return {
          success: false,
          message: 'Crawl job not found',
          data: null,
        };
      }


      if (Number(existingJob.user_id) !== Number(user.id)) {
        return {
          success: false,
          message: 'Unauthorized to update this crawl job',
          data: null,
        };
      }

      const updateData: any = {};
      if (updates.status) updateData.status = updates.status;
      if (updates.start_time) updateData.start_time = updates.start_time;
      if (updates.end_time) updateData.end_time = updates.end_time;
      if (updates.records_scrapped !== undefined) updateData.records_scrapped = updates.records_scrapped;
      if (updates.description) updateData.description = updates.description;
      if (updates.title) updateData.title = updates.title;

      await this.crawlJobsRepository.updateAll(updateData, {job_id: id});
      const updatedJob = await this.crawlJobsRepository.findOne({
        where: {job_id: id}
      });

      return {
        success: true,
        message: 'Crawl job updated successfully',
        data: updatedJob,
      };
    } catch (error) {
      console.error('Error updating crawl job:', error);
      return {
        success: false,
        message: 'Failed to update crawl job',
        data: null,
      };
    }
  }

  /**
   * Delete a crawl job
   * DELETE /crawl-jobs/{id}
   */
  @del('/crawl-jobs/{id}')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Crawl job deleted successfully',
  })
  async deleteCrawlJob(@param.path.string('id') id: string) {
    try {
      // Validate UUID format
      const uuidRegex = /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i;
      if (!uuidRegex.test(id)) {
        return {
          success: false,
          message: 'Invalid job ID format. Please provide a valid UUID.',
          data: null,
        };
      }
      const user = (this.request as any).user;
      if (!user) {
        return {
          success: false,
          message: 'User not authenticated',
          data: null,
        };
      }

      const existingJob = await this.crawlJobsRepository.findOne({
        where: {job_id: id}
      });
      if (!existingJob) {
        return {
          success: false,
          message: 'Crawl job not found',
          data: null,
        };
      }

      if (Number(existingJob.user_id) !== Number(user.id)) {
        return {
          success: false,
          message: 'Unauthorized to delete this crawl job',
          data: null,
        };
      }

      await this.crawlJobsRepository.deleteAll({job_id: id});

      return {
        success: true,
        message: 'Crawl job deleted successfully',
        data: null,
      };
    } catch (error) {
      console.error('Error deleting crawl job:', error);
      return {
        success: false,
        message: 'Failed to delete crawl job',
        data: null,
      };
    }
  }

  /**
   * Validate job parameters against lead source schema
   */
  private async validateJobParameters(sourceId: number, params: any) {
    try {
      const leadSource = await this.leadSourcesRepository.findById(sourceId);
      if (!leadSource) {
        return {valid: false, errors: ['Lead source not found']};
      }

      const inputSchema = typeof leadSource.input_schema === 'string' 
        ? JSON.parse(leadSource.input_schema) 
        : leadSource.input_schema;

      if (!inputSchema || !inputSchema.properties) {
        return {valid: true, errors: []}; // No schema to validate against
      }

      const errors: string[] = [];
      const requiredFields = inputSchema.required || [];

      // Check required fields
      for (const field of requiredFields) {
        if (!(field in params) || params[field] === null || params[field] === undefined || params[field] === '') {
          errors.push(`Required field '${field}' is missing`);
        }
      }

      // Check field types and constraints
      for (const [fieldName, fieldSchema] of Object.entries(inputSchema.properties)) {
        const value = params[fieldName];
        if (value !== undefined && value !== null && value !== '') {
          const schema = fieldSchema as any;
          
          // Type validation
          if (schema.type === 'string' && typeof value !== 'string') {
            errors.push(`Field '${fieldName}' must be a string`);
          } else if (schema.type === 'number' && typeof value !== 'number') {
            errors.push(`Field '${fieldName}' must be a number`);
          } else if (schema.type === 'boolean' && typeof value !== 'boolean') {
            errors.push(`Field '${fieldName}' must be a boolean`);
          }

          // String length validation
          if (schema.type === 'string' && schema.maxLength && value.length > schema.maxLength) {
            errors.push(`Field '${fieldName}' exceeds maximum length of ${schema.maxLength}`);
          }
          if (schema.type === 'string' && schema.minLength && value.length < schema.minLength) {
            errors.push(`Field '${fieldName}' is shorter than minimum length of ${schema.minLength}`);
          }

          // Number range validation
          if (schema.type === 'number' && schema.maximum && value > schema.maximum) {
            errors.push(`Field '${fieldName}' exceeds maximum value of ${schema.maximum}`);
          }
          if (schema.type === 'number' && schema.minimum && value < schema.minimum) {
            errors.push(`Field '${fieldName}' is less than minimum value of ${schema.minimum}`);
          }
        }
      }

      return {valid: errors.length === 0, errors};
    } catch (error) {
      console.error('Error validating job parameters:', error);
      return {valid: false, errors: ['Failed to validate parameters']};
    }
  }

  /**
   * Check rate limits for the account
   */
  private async checkRateLimits(accountId: string) {
    try {
      // Get job count for the last 24 hours
      const oneDayAgo = new Date();
      oneDayAgo.setDate(oneDayAgo.getDate() - 1);

      const jobCount = await this.crawlJobsRepository.count({
        account_id: parseInt(accountId),
        start_time: {gte: oneDayAgo},
      });

      // Rate limit: 10 jobs per day
      const maxJobsPerDay = 10;
      if (jobCount.count >= maxJobsPerDay) {
        return {
          allowed: false,
          message: `Daily limit of ${maxJobsPerDay} jobs exceeded. You have created ${jobCount.count} jobs in the last 24 hours.`,
        };
      }

      return {allowed: true, message: ''};
    } catch (error) {
      console.error('Error checking rate limits:', error);
      return {allowed: true, message: ''}; // Allow on error
    }
  }
}
