import {inject, intercept} from '@loopback/core';
import {
  get,
  response,
  RestBindings,
  Request,
} from '@loopback/rest';
import {LeadSourcesRepository, AccountLeadSourcesRepository} from '../repositories';
import {LeadSourcesResponse, LeadSourceWithParams, LeadSourceParam} from '../types/leadsource.types';
import {AuthInterceptor} from '../interceptors/auth.interceptor';

/**
 * LeadSource Controller
 * Provides protected API to fetch lead sources with their required fields
 */
export class LeadSourceController {
  constructor(
    @inject(RestBindings.Http.REQUEST) private request: Request,
    @inject('repositories.LeadSourcesRepository') private leadSourcesRepository: LeadSourcesRepository,
    @inject('repositories.AccountLeadSourcesRepository') private accountLeadSourcesRepository: AccountLeadSourcesRepository,
  ) {}


  /**
   * Get lead sources available for the authenticated account
   * GET /lead-sources
   */
  @get('/lead-sources')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'List of lead sources with their required parameters',
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
                  name: {type: 'string'},
                  description: {type: 'string'},
                  is_active: {type: 'boolean'},
                  params: {
                    type: 'array',
                    items: {
                      type: 'object',
                      properties: {
                        name: {type: 'string'},
                        type: {type: 'string'},
                        required: {type: 'boolean'},
                        description: {type: 'string'},
                        default: {},
                        validation: {
                          type: 'object',
                          properties: {
                            min: {type: 'number'},
                            max: {type: 'number'},
                            pattern: {type: 'string'},
                            enum: {type: 'array', items: {type: 'string'}},
                          },
                        },
                      },
                    },
                  },
                },
              },
            },
          },
        },
      },
    },
  })
  async getLeadSources(): Promise<LeadSourcesResponse> {
    // Get user information from the request (set by auth middleware)
    const user = (this.request as any).user;

    if (!user) {
      return {
        success: false,
        message: 'Authentication required. Please provide a valid JWT token.',
        data: [],
      };
    }

    const accountId = user.account_id;

    try {
      // Get enabled lead sources for this account
      const accountLeadSources = await this.accountLeadSourcesRepository.find({
        where: {
          account_id: accountId,
          is_enabled: true,
        },
      });

      if (accountLeadSources.length === 0) {
        return {
          success: true,
          message: 'No lead sources available for this account',
          data: [],
        };
      }

      // Get the source IDs
      const sourceIds = accountLeadSources.map(als => als.source_id);

      // Get the lead sources details
      const leadSources = await this.leadSourcesRepository.find({
        where: {
          id: {inq: sourceIds},
          is_active: true,
        },
      });

      // Transform the data to include parsed parameters
      const leadSourcesWithParams: LeadSourceWithParams[] = leadSources.map(source => {
        let params: LeadSourceParam[] = [];
        
        try {
          // Parse the input_schema JSONB field
          const inputSchema = typeof source.input_schema === 'string' 
            ? JSON.parse(source.input_schema) 
            : source.input_schema;
          
          // Transform schema to our parameter format
          if (inputSchema && inputSchema.properties) {
            params = Object.entries(inputSchema.properties).map(([name, schema]: [string, any]) => ({
              name,
              type: schema.type || 'string',
              required: inputSchema.required?.includes(name) || false,
              description: schema.description,
              default: schema.default,
              validation: {
                min: schema.minimum,
                max: schema.maximum,
                pattern: schema.pattern,
                enum: schema.enum,
              },
            }));
          }
        } catch (error) {
          console.warn(`Failed to parse input_schema for lead source ${source.id}:`, error);
          // If parsing fails, return empty params array
          params = [];
        }

        return {
          id: source.id,
          name: source.name,
          description: source.description,
          is_active: source.is_active,
          params,
        };
      });

      return {
        success: true,
        message: 'Lead sources retrieved successfully',
        data: leadSourcesWithParams,
      };
    } catch (error) {
      console.error('Error fetching lead sources:', error);
      throw new Error('Failed to fetch lead sources');
    }
  }

  /**
   * Get lead sources with saved inputs for the authenticated account
   * GET /lead-sources/with-saved-inputs
   */
  @get('/lead-sources/with-saved-inputs')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'List of lead sources with their saved inputs',
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
                  name: {type: 'string'},
                  description: {type: 'string'},
                  is_active: {type: 'boolean'},
                  params: {
                    type: 'array',
                    items: {
                      type: 'object',
                      properties: {
                        name: {type: 'string'},
                        type: {type: 'string'},
                        required: {type: 'boolean'},
                        description: {type: 'string'},
                        default: {},
                        validation: {
                          type: 'object',
                          properties: {
                            min: {type: 'number'},
                            max: {type: 'number'},
                            pattern: {type: 'string'},
                            enum: {type: 'array', items: {type: 'string'}},
                          },
                        },
                      },
                    },
                  },
                  saved_inputs: {
                    type: 'array',
                    items: {
                      type: 'object',
                      properties: {
                        id: {type: 'number'},
                        name: {type: 'string'},
                        source_id: {type: 'number'},
                        params: {type: 'object'},
                        is_active: {type: 'boolean'},
                        created_at: {type: 'string'},
                        updated_at: {type: 'string'},
                      },
                    },
                  },
                },
              },
            },
          },
        },
      },
    },
  })
  async getLeadSourcesWithSavedInputs(): Promise<LeadSourcesResponse> {
    // Get user information from the request (set by auth middleware)
    const user = (this.request as any).user;

    if (!user) {
      return {
        success: false,
        message: 'Authentication required. Please provide a valid JWT token.',
        data: [],
      };
    }

    const accountId = user.account_id;

    try {
      // Get enabled lead sources for this account
      const accountLeadSources = await this.accountLeadSourcesRepository.find({
        where: {
          account_id: accountId,
          is_enabled: true,
        },
      });

      if (accountLeadSources.length === 0) {
        return {
          success: true,
          message: 'No lead sources available for this account',
          data: [],
        };
      }

      // Get the source IDs
      const sourceIds = accountLeadSources.map(als => als.source_id);

      // Get the lead sources details
      const leadSources = await this.leadSourcesRepository.find({
        where: {
          id: {inq: sourceIds},
          is_active: true,
        },
      });

      // Note: Saved inputs functionality has been removed

      // Transform the data
      const leadSourcesWithSavedInputs = leadSources.map(source => {
        let params: LeadSourceParam[] = [];
        
        try {
          // Parse the input_schema JSONB field
          const inputSchema = typeof source.input_schema === 'string' 
            ? JSON.parse(source.input_schema) 
            : source.input_schema;
          
          // Transform schema to our parameter format
          if (inputSchema && inputSchema.properties) {
            params = Object.entries(inputSchema.properties).map(([name, schema]: [string, any]) => ({
              name,
              type: schema.type || 'string',
              required: inputSchema.required?.includes(name) || false,
              description: schema.description,
              default: schema.default,
              validation: {
                min: schema.minimum,
                max: schema.maximum,
                pattern: schema.pattern,
                enum: schema.enum,
              },
            }));
          }
        } catch (error) {
          console.warn(`Failed to parse input_schema for lead source ${source.id}:`, error);
          params = [];
        }

        // Note: Saved inputs functionality has been removed
        const sourceSavedInputs: any[] = [];

        return {
          id: source.id,
          name: source.name,
          description: source.description,
          is_active: source.is_active,
          params,
          saved_inputs: sourceSavedInputs,
        };
      });

      return {
        success: true,
        message: 'Lead sources with saved inputs retrieved successfully',
        data: leadSourcesWithSavedInputs,
      };
    } catch (error) {
      console.error('Error fetching lead sources with saved inputs:', error);
      throw new Error('Failed to fetch lead sources with saved inputs');
    }
  }
}
