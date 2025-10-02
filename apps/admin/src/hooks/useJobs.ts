import { useState, useEffect, useCallback } from 'react';
import { Job, JobsFilters, JobInputs } from '../types/jobs';
import { jobsApiService } from '../services/api/jobsApi';

interface UseJobsReturn {
  jobs: Job[];
  loading: boolean;
  error: string | null;
  total: number;
  page: number;
  pageSize: number;
  totalPages: number;
  filters: JobsFilters;
  setFilters: (filters: JobsFilters) => void;
  refreshJobs: () => Promise<void>;
  stopJob: (jobId: string) => Promise<boolean>;
  deleteJob: (jobId: string) => Promise<boolean>;
  getJobInputs: (jobId: string) => Promise<JobInputs | null>;
}

export const useJobs = (): UseJobsReturn => {
  const [jobs, setJobs] = useState<Job[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [total, setTotal] = useState(0);
  const [page, setPage] = useState(1);
  const [pageSize] = useState(25);
  const [totalPages, setTotalPages] = useState(0);
  const [filters, setFiltersState] = useState<JobsFilters>({});

  const fetchJobs = useCallback(async () => {
    setLoading(true);
    setError(null);

    try {
      const response = await jobsApiService.getJobs({
        ...filters,
        page,
        pageSize,
      });

      setJobs(response.jobs);
      setTotal(response.total);
      setTotalPages(response.totalPages);
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Failed to fetch jobs');
      console.error('Error fetching jobs:', err);
    } finally {
      setLoading(false);
    }
  }, [filters, page, pageSize]);

  const setFilters = useCallback((newFilters: JobsFilters) => {
    setFiltersState(newFilters);
    setPage(1); // Reset to first page when filters change
  }, []);

  const refreshJobs = useCallback(async () => {
    await fetchJobs();
  }, [fetchJobs]);

  const stopJob = useCallback(async (jobId: string): Promise<boolean> => {
    try {
      await jobsApiService.stopJob(jobId);
      await refreshJobs(); // Refresh the list to show updated status
      return true;
    } catch (err) {
      console.error('Error stopping job:', err);
      return false;
    }
  }, [refreshJobs]);

  const deleteJob = useCallback(async (jobId: string): Promise<boolean> => {
    try {
      await jobsApiService.deleteJob(jobId);
      await refreshJobs(); // Refresh the list to remove deleted job
      return true;
    } catch (err) {
      console.error('Error deleting job:', err);
      return false;
    }
  }, [refreshJobs]);

  const getJobInputs = useCallback(async (jobId: string): Promise<JobInputs | null> => {
    try {
      return await jobsApiService.getJobInputs(jobId);
    } catch (err) {
      console.error('Error fetching job inputs:', err);
      return null;
    }
  }, []);

  // Auto-refresh every 30 seconds
  useEffect(() => {
    fetchJobs();

    const interval = setInterval(() => {
      fetchJobs();
    }, 30000);

    return () => clearInterval(interval);
  }, [fetchJobs]);

  return {
    jobs,
    loading,
    error,
    total,
    page,
    pageSize,
    totalPages,
    filters,
    setFilters,
    refreshJobs,
    stopJob,
    deleteJob,
    getJobInputs,
  };
};
