export interface DataSourceParam {
  name: string;
  type: 'string' | 'number' | 'integer' | 'boolean' | 'date' | 'datetime' | 'email' | 'url' | 'array';
  required: boolean;
  description: string;
  default?: string | number | boolean | string[];
  validation?: {
    min?: number;
    max?: number;
    pattern?: string;
    enum?: string[];
  };
}

export interface DataSource {
  id: number;
  name: string;
  description: string;
  is_active: boolean;
  params: DataSourceParam[];
}

export interface DataSourcesResponse {
  success: boolean;
  message: string;
  data: DataSource[];
}

export interface JobParams {
  [key: string]: string | number | boolean | string[];
}

export interface JobSchedule {
  type: 'one_time' | 'recurring';
  runAt?: string;
  recurring?: {
    preset: 'daily' | 'weekly' | 'monthly' | 'cron';
    time: string;
    daysOfWeek?: string[];
    dayOfMonth?: number;
    cron?: string;
  };
}

export interface CreateJobRequest {
  timezone: string;
  schedule?: JobSchedule; // Made optional since schedule is commented out for now
  jobs: {
    sourceId: string;
    title: string;
    description?: string;
    params: JobParams;
  }[];
}

export interface CreatedJob {
  job_id: string;
  source_id: number;
  title: string;
  status: string;
}

export interface FailedJob {
  source_id: number;
  title: string;
  error: string;
}

export interface CreateJobResponse {
  success: boolean;
  message: string;
  data?: {
    jobIds: string[];
    createdCount: number;
    failedCount: number;
    createdJobs: CreatedJob[];
    failedJobs: FailedJob[];
  };
}

export interface ValidationError {
  sourceId: number;
  path: string;
  message: string;
}

export interface CreateJobError {
  error: string;
  details: ValidationError[];
}
