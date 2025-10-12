import { DataSourcesResponse, CreateJobRequest, CreateJobResponse } from '../../types/datasources';

// const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:3011/api/v1';

class DataSourcesApiService {

  async getDataSources(): Promise<DataSourcesResponse> {
    // Use real API endpoint
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      const response = await fetch('http://127.0.0.1:3011/api/v1/lead-sources', {
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
        throw new Error(data.message || 'Failed to fetch data sources');
      }

      // Transform API response to match our interface
      const transformedDataSources = data.data.map((source: any) => ({
        id: source.id,
        name: source.name,
        description: source.description,
        is_active: source.is_active,
        params: source.params.map((param: any) => ({
          name: param.name,
          type: param.type,
          required: param.required,
          description: param.description,
          default: param.default,
          validation: param.validation || {}
        }))
      }));

      return {
        success: true,
        message: data.message || 'Data sources retrieved successfully',
        data: transformedDataSources
      };
    } catch (error) {
      console.error('Error fetching data sources from API:', error);
      // Fallback to mock data if API fails
      return this.getMockDataSources();
    }
  }

  private getMockDataSources(): DataSourcesResponse {
    // Fallback mock data
    const mockData: DataSourcesResponse = {
      success: true,
      message: "Data sources loaded successfully",
      data: [
        {
          id: 1,
          name: "Google Maps",
          description: "Scrape business listings from Google Maps",
          is_active: true,
          params: [
            {
              name: "keywords",
              type: "string",
              required: true,
              description: "Search keywords for businesses",
              default: "restaurants",
              validation: {
                min: 2,
                max: 100
              }
            },
            {
              name: "location",
              type: "string",
              required: true,
              description: "City or area to search in",
              default: "New York",
              validation: {
                min: 2,
                max: 50
              }
            }
          ]
        }
      ]
    };
    
    return mockData;
  }

  async createJobs(jobData: CreateJobRequest): Promise<CreateJobResponse> {
    const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImVtYWlsIjoiam9obkB0ZWNoY29ycC5jb20iLCJuYW1lIjoiSm9obiBTbWl0aCIsInJvbGUiOiJhZG1pbiIsImFjY291bnRfaWQiOiIxIiwic3RhdHVzIjoiYWN0aXZlIiwiYWNjb3VudCI6eyJpZCI6MSwibmFtZSI6IlRlc3QgQWNjb3VudCIsImRvbWFpbiI6InRlY2hjb3JwLmNvbSIsInN0YXR1cyI6ImFjdGl2ZSJ9LCJpYXQiOjE3NTk0MjQwNzQsImV4cCI6MTc1OTUxMDQ3NCwiYXVkIjoibGVhZC1nZW4tdXNlcnMiLCJpc3MiOiJsZWFkLWdlbi1hcGkifQ.6Qy3xg1-CRkqtRH6CMFl3lsc136nmNrg2hqSBS6Zn8A';
    
    try {
      // Transform our job data to match the API format
      const apiJobData = {
        jobs: jobData.jobs.map(job => ({
          source_id: parseInt(job.sourceId),
          title: job.title,
          description: job.description || undefined,
          params: job.params
        }))
      };

      const response = await fetch('http://127.0.0.1:3011/api/v1/crawl-jobs/bulk', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(apiJobData),
      });

      if (!response.ok) {
        // Handle validation errors
        if (response.status === 422) {
          const errorData = await response.json();
          throw new Error(`Validation failed: ${errorData.error?.message || 'Invalid request data'}`);
        }
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      
      if (!data.success) {
        throw new Error(data.message || 'Failed to create jobs');
      }

      // Transform API response to match our interface
      const createdJobIds = data.data?.created_jobs?.map((job: any) => job.job_id) || [];
      const totalCreated = data.data?.total_created || 0;
      const totalFailed = data.data?.total_failed || 0;

      return {
        success: true,
        message: data.message || `Successfully created ${totalCreated} job(s), ${totalFailed} failed`,
        data: {
          jobIds: createdJobIds,
          createdCount: totalCreated,
          failedCount: totalFailed,
          createdJobs: data.data?.created_jobs || [],
          failedJobs: data.data?.failed_jobs || []
        }
      };
    } catch (error) {
      console.error('Error creating jobs:', error);
      // Fallback to mock response
      return {
        success: false,
        message: `Failed to create jobs: ${error instanceof Error ? error.message : 'Unknown error'}`,
        data: {
          jobIds: [],
          createdCount: 0,
          failedCount: jobData.jobs.length,
          createdJobs: [],
          failedJobs: jobData.jobs.map(job => ({
            source_id: parseInt(job.sourceId),
            title: job.title,
            error: 'Failed to create job'
          }))
        }
      };
    }
  }
}

export const datasourcesApiService = new DataSourcesApiService();
