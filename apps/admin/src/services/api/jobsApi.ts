import { Job, JobsResponse, JobsFilters, JobInputs, JobActionResponse, JobStatus } from '../../types/jobs';

// const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:3011/api/v1';

class JobsApiService {

  async getJobs(filters: JobsFilters = {}): Promise<JobsResponse> {
    // Use real API endpoint with query parameters
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A'    
    // Build query parameters
    const queryParams = new URLSearchParams();
    
    if (filters.status) {
      queryParams.append('status', filters.status);
    }
    
    if (filters.source) {
      // Map source names to source IDs
      const sourceIdMap: { [key: string]: string } = {
        'Google Maps': '1',
        'LinkedIn': '2', 
        'Metal': '3',
        'Facebook Pages': '4'
      };
      const sourceId = sourceIdMap[filters.source];
      if (sourceId) {
        queryParams.append('source_id', sourceId);
      }
    }
    
    if (filters.q) {
      queryParams.append('search', filters.q);
    }
    
    if (filters.pageSize) {
      queryParams.append('limit', filters.pageSize.toString());
    }
    
    if (filters.page && filters.page > 1) {
      queryParams.append('offset', ((filters.page - 1) * (filters.pageSize || 25)).toString());
    }
    
    const url = `http://127.0.0.1:3011/api/v1/crawl-jobs${queryParams.toString() ? `?${queryParams.toString()}` : ''}`;
    
    try {
      const response = await fetch(url, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      if (!data.success) {
        throw new Error(data.message || 'Failed to fetch jobs');
      }

      // Transform API response to match our interface
      const transformedJobs = data.data.map((job: any) => ({
        id: job.job_id,
        title: job.title,
        sources: [this.getSourceName(job.lead_source_id)],
        recordsScraped: parseInt(job.records_scrapped) || 0,
        status: this.mapStatus(job.status),
        createdAt: job.start_time || new Date().toISOString(),
        lastRun: job.end_time,
        inputs: {
          id: `input-${job.job_id}`,
          jobId: job.job_id,
          parameters: job.params || {},
          searchCriteria: {},
          filters: {},
          createdAt: job.start_time || new Date().toISOString(),
          updatedAt: job.end_time || new Date().toISOString()
        }
      }));

      // API already handles filtering and pagination, so return the results directly
      const page = filters.page || 1;
      const pageSize = filters.pageSize || 25;
      const total = data.total || transformedJobs.length;
      const totalPages = Math.ceil(total / pageSize);

      return {
        jobs: transformedJobs,
        total,
        page,
        pageSize,
        totalPages
      };
    } catch (error) {
      console.error('Error fetching jobs from API:', error);
      // Fallback to mock data if API fails
      return this.getMockJobs(filters);
    }
  }

  private getSourceName(leadSourceId: string): string {
    const sourceMap: { [key: string]: string } = {
      '1': 'Google Maps',
      '2': 'LinkedIn',
      '3': 'Metal',
      '4': 'Facebook Pages'
    };
    return sourceMap[leadSourceId] || 'Unknown Source';
  }

  private mapStatus(apiStatus: string): JobStatus {
    const statusMap: { [key: string]: JobStatus } = {
      'pending': 'pending',
      'running': 'running',
      'stopped': 'stopped',
      'terminated': 'failed',
      'completed': 'success',
      'failed': 'failed'
    };
    return statusMap[apiStatus] || 'pending';
  }

  private getMockJobs(filters: JobsFilters = {}): JobsResponse {
    // Fallback mock data
    const mockJobs = [
      {
        id: 'job-001',
        title: 'Google Maps - Restaurants NYC',
        sources: ['Google Maps'],
        recordsScraped: 1247,
        status: 'success' as const,
        createdAt: '2024-01-15T10:30:00Z',
        lastRun: '2024-01-15T10:45:00Z',
        inputs: {
          id: 'input-001',
          jobId: 'job-001',
          parameters: {
            keywords: 'restaurants',
            location: 'New York',
            radiusKm: 10,
            businessType: 'restaurant',
            includeReviews: true
          },
          searchCriteria: {
            minRating: 4.0,
            maxResults: 1000
          },
          filters: {
            openNow: true,
            priceLevel: 'moderate'
          },
          createdAt: '2024-01-15T10:30:00Z',
          updatedAt: '2024-01-15T10:30:00Z'
        }
      }
    ];

    // Apply filters
    let filteredJobs = [...mockJobs];

    if (filters.status) {
      filteredJobs = filteredJobs.filter(job => job.status === filters.status);
    }

    if (filters.source) {
      filteredJobs = filteredJobs.filter(job => 
        job.sources.some((source: string) => source.toLowerCase().includes(filters.source!.toLowerCase()))
      );
    }

    if (filters.q) {
      const query = filters.q.toLowerCase();
      filteredJobs = filteredJobs.filter(job => 
        job.title.toLowerCase().includes(query) ||
        job.id.toLowerCase().includes(query) ||
        job.sources.some((source: string) => source.toLowerCase().includes(query))
      );
    }

    // Pagination
    const page = filters.page || 1;
    const pageSize = filters.pageSize || 25;
    const startIndex = (page - 1) * pageSize;
    const endIndex = startIndex + pageSize;
    const paginatedJobs = filteredJobs.slice(startIndex, endIndex);

    const totalPages = Math.ceil(filteredJobs.length / pageSize);

    return {
      jobs: paginatedJobs,
      total: filteredJobs.length,
      page,
      pageSize,
      totalPages
    };
  }

  async getJobInputs(jobId: string): Promise<JobInputs> {
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      const response = await fetch(`http://127.0.0.1:3011/api/v1/crawl-jobs/${jobId}/inputs`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      if (!data.success) {
        throw new Error(data.message || 'Failed to fetch job inputs');
      }

      return {
        id: `input-${jobId}`,
        jobId: jobId,
        parameters: data.data.params || {},
        searchCriteria: data.data.searchCriteria || {},
        filters: data.data.filters || {},
        createdAt: data.data.createdAt || new Date().toISOString(),
        updatedAt: data.data.updatedAt || new Date().toISOString()
      };
    } catch (error) {
      console.error('Error fetching job inputs:', error);
      // Fallback to mock data
      return {
        id: `input-${jobId}`,
        jobId: jobId,
        parameters: {
          keywords: 'restaurants',
          location: 'New York',
          radiusKm: 10,
          businessType: 'restaurant',
          includeReviews: true
        },
        searchCriteria: {
          minRating: 4.0,
          maxResults: 1000,
          openNow: true,
          priceLevel: 'moderate'
        },
        filters: {
          hasWebsite: true,
          acceptsReservations: true,
          isActive: true
        },
        createdAt: '2024-01-15T10:30:00Z',
        updatedAt: '2024-01-15T10:30:00Z'
      };
    }
  }

  async stopJob(jobId: string): Promise<JobActionResponse> {
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      const response = await fetch(`http://127.0.0.1:3011/api/v1/crawl-jobs/${jobId}/stop`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      return {
        success: data.success || true,
        message: data.message || `Job ${jobId} stopped successfully`,
        job: data.data ? {
          id: data.data.job_id || jobId,
          title: data.data.title || 'Job',
          sources: [this.getSourceName(data.data.lead_source_id)],
          recordsScraped: parseInt(data.data.records_scrapped) || 0,
          status: this.mapStatus(data.data.status),
          createdAt: data.data.start_time || new Date().toISOString()
        } : undefined
      };
    } catch (error) {
      console.error('Error stopping job:', error);
      return {
        success: false,
        message: `Failed to stop job ${jobId}: ${error instanceof Error ? error.message : 'Unknown error'}`
      };
    }
  }

  async deleteJob(jobId: string): Promise<JobActionResponse> {
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      const response = await fetch(`http://127.0.0.1:3011/api/v1/crawl-jobs/${jobId}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      return {
        success: data.success || true,
        message: data.message || `Job ${jobId} deleted successfully`
      };
    } catch (error) {
      console.error('Error deleting job:', error);
      return {
        success: false,
        message: `Failed to delete job ${jobId}: ${error instanceof Error ? error.message : 'Unknown error'}`
      };
    }
  }

  async getJob(jobId: string): Promise<Job> {
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      const response = await fetch(`http://127.0.0.1:3011/api/v1/crawl-jobs/${jobId}`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      if (!data.success) {
        throw new Error(data.message || 'Failed to fetch job');
      }

      const job = data.data;
      return {
        id: job.job_id,
        title: job.title,
        sources: [this.getSourceName(job.lead_source_id)],
        recordsScraped: parseInt(job.records_scrapped) || 0,
        status: this.mapStatus(job.status),
        createdAt: job.start_time || new Date().toISOString(),
        lastRun: job.end_time
      };
    } catch (error) {
      console.error('Error fetching job:', error);
      // Fallback to mock data
      return {
        id: jobId,
        title: 'Mock Job Details',
        sources: ['Google Maps'],
        recordsScraped: 150,
        status: 'success',
        createdAt: '2024-01-15T10:30:00Z',
        lastRun: '2024-01-15T10:45:00Z'
      };
    }
  }
}

export const jobsApiService = new JobsApiService();
