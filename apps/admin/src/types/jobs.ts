export interface Job {
  id: string;
  title: string;
  sources: string[];
  recordsScraped: number;
  status: JobStatus;
  createdAt: string;
  lastRun?: string;
  inputs?: JobInputs;
}

export type JobStatus = 
  | 'running' 
  | 'pending' 
  | 'verifying' 
  | 'updating' 
  | 'starting' 
  | 'success' 
  | 'failed' 
  | 'paused' 
  | 'stopped';

export interface JobInputs {
  id: string;
  jobId: string;
  parameters: Record<string, any>;
  searchCriteria: Record<string, any>;
  filters: Record<string, any>;
  createdAt: string;
  updatedAt: string;
}

export interface JobsResponse {
  jobs: Job[];
  total: number;
  page: number;
  pageSize: number;
  totalPages: number;
}

export interface JobsFilters {
  status?: JobStatus;
  source?: string;
  q?: string;
  page?: number;
  pageSize?: number;
}

export interface JobActionResponse {
  success: boolean;
  message: string;
  job?: Job;
}
