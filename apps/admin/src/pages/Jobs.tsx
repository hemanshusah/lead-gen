import {
  Box,
  VStack,
  HStack,
  Heading,
  Text,
  Button,
  Input,
  Select,
  InputGroup,
  InputLeftElement,
  useDisclosure,
  useToast,
  Card,
  CardBody,
  Flex,
  Badge,
  Container,
  useColorModeValue,
} from '@chakra-ui/react';
import { FiSearch, FiRefreshCw, FiPlus } from 'react-icons/fi';
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useJobs } from '../hooks/useJobs';
import JobsTable from '../components/JobsTable';
import JobInputsModal from '../components/JobInputsModal';
import { JobInputs, JobStatus } from '../types/jobs';

const Jobs: React.FC = () => {
  const navigate = useNavigate();
  const {
    jobs,
    loading,
    error,
    total,
    page,
    totalPages,
    filters,
    setFilters,
    refreshJobs,
    stopJob,
    deleteJob,
    getJobInputs,
  } = useJobs();

  const [searchQuery, setSearchQuery] = useState('');
  const [statusFilter, setStatusFilter] = useState<JobStatus | ''>('');
  const [sourceFilter, setSourceFilter] = useState('');
  const [, setSelectedJobId] = useState<string | null>(null);
  const [jobInputs, setJobInputs] = useState<JobInputs | null>(null);
  const [inputsLoading, setInputsLoading] = useState(false);
  const [inputsError, setInputsError] = useState<string | null>(null);

  const { isOpen, onOpen, onClose } = useDisclosure();
  const toast = useToast();

  // Apply filters when they change
  useEffect(() => {
    const newFilters: any = {};
    if (searchQuery.trim()) newFilters.q = searchQuery.trim();
    if (statusFilter) newFilters.status = statusFilter;
    if (sourceFilter.trim()) newFilters.source = sourceFilter.trim();
    
    setFilters(newFilters);
  }, [searchQuery, statusFilter, sourceFilter, setFilters]);

  const handleViewInputs = async (jobId: string) => {
    setSelectedJobId(jobId);
    setInputsLoading(true);
    setInputsError(null);
    onOpen();

    try {
      const inputs = await getJobInputs(jobId);
      if (inputs) {
        setJobInputs(inputs);
      } else {
        setInputsError('Failed to load job inputs');
      }
    } catch (err) {
      setInputsError(err instanceof Error ? err.message : 'Failed to load job inputs');
    } finally {
      setInputsLoading(false);
    }
  };

  const handleRefresh = async () => {
    await refreshJobs();
    toast({
      title: 'Jobs refreshed',
      status: 'success',
      duration: 2000,
      isClosable: true,
    });
  };

  const handleCreateNewJob = () => {
    navigate('/jobs/new');
  };

  const handleStopJob = async (jobId: string): Promise<boolean> => {
    return await stopJob(jobId);
  };

  const handleDeleteJob = async (jobId: string): Promise<boolean> => {
    return await deleteJob(jobId);
  };

  const statusOptions: { value: JobStatus | ''; label: string }[] = [
    { value: '', label: 'All Statuses' },
    { value: 'running', label: 'Running' },
    { value: 'pending', label: 'Pending' },
    { value: 'verifying', label: 'Verifying' },
    { value: 'updating', label: 'Updating' },
    { value: 'starting', label: 'Starting' },
    { value: 'success', label: 'Success' },
    { value: 'failed', label: 'Failed' },
    { value: 'paused', label: 'Paused' },
    { value: 'stopped', label: 'Stopped' },
  ];

  const sourceOptions = [
    { value: '', label: 'All Sources' },
    { value: 'Google Maps', label: 'Google Maps' },
    { value: 'LinkedIn', label: 'LinkedIn' },
    { value: 'Metal', label: 'Metal' },
  ];

  const bg = useColorModeValue('gray.50', 'gray.900');
  const headerBg = useColorModeValue('white', 'gray.800');
  const borderColor = useColorModeValue('gray.200', 'gray.700');

  return (
    <Box minH="100vh" bg={bg}>
      {/* Header */}
      <Box bg={headerBg} borderBottom="1px" borderColor={borderColor} px={6} py={4}>
        <Container maxW="7xl">
          <Flex justify="space-between" align="center">
            <Box>
              <Heading size="lg" color="brand.500" mb={1}>
                Scrapping Jobs
              </Heading>
              <Text color="gray.600" fontSize="sm">
                Monitor and manage your scraping jobs
              </Text>
            </Box>
            <HStack spacing={3}>
              <Button
                leftIcon={<FiRefreshCw />}
                onClick={handleRefresh}
                variant="outline"
                size="sm"
              >
                Refresh
              </Button>
              <Button
                leftIcon={<FiPlus />}
                onClick={handleCreateNewJob}
                colorScheme="brand"
                size="sm"
              >
                Create New Job
              </Button>
            </HStack>
          </Flex>
        </Container>
      </Box>

      {/* Main Content */}
      <Container maxW="7xl" py={8}>
        <VStack spacing={6} align="stretch">

        {/* Stats Cards */}
        <HStack spacing={4} mb={6} w="full">
          <Card flex="1">
            <CardBody p={6}>
              <HStack justify="center">
                <Text fontSize="2xl" fontWeight="bold" color="blue.500">
                  {total}
                </Text>
                <Text fontSize="sm" color="gray.600">
                  Total Jobs
                </Text>
              </HStack>
            </CardBody>
          </Card>
          <Card flex="1">
            <CardBody p={6}>
              <HStack justify="center">
                <Text fontSize="2xl" fontWeight="bold" color="green.500">
                  {jobs.filter(job => job.status === 'success').length}
                </Text>
                <Text fontSize="sm" color="gray.600">
                  Successful
                </Text>
              </HStack>
            </CardBody>
          </Card>
          <Card flex="1">
            <CardBody p={6}>
              <HStack justify="center">
                <Text fontSize="2xl" fontWeight="bold" color="blue.500">
                  {jobs.filter(job => job.status === 'running').length}
                </Text>
                <Text fontSize="sm" color="gray.600">
                  Running
                </Text>
              </HStack>
            </CardBody>
          </Card>
          <Card flex="1">
            <CardBody p={6}>
              <HStack justify="center">
                <Text fontSize="2xl" fontWeight="bold" color="red.500">
                  {jobs.filter(job => job.status === 'failed').length}
                </Text>
                <Text fontSize="sm" color="gray.600">
                  Failed
                </Text>
              </HStack>
            </CardBody>
          </Card>
        </HStack>

        {/* Filters */}
        <Card>
          <CardBody>
            <HStack spacing={4} wrap="wrap">
              <InputGroup maxW="300px">
                <InputLeftElement pointerEvents="none">
                  <FiSearch color="gray.300" />
                </InputLeftElement>
                <Input
                  placeholder="Search jobs..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                />
              </InputGroup>

              <Select
                placeholder="Filter by status"
                value={statusFilter}
                onChange={(e) => setStatusFilter(e.target.value as JobStatus | '')}
                maxW="200px"
              >
                {statusOptions.map((option) => (
                  <option key={option.value} value={option.value}>
                    {option.label}
                  </option>
                ))}
              </Select>

              <Select
                placeholder="Filter by source"
                value={sourceFilter}
                onChange={(e) => setSourceFilter(e.target.value)}
                maxW="200px"
              >
                {sourceOptions.map((option) => (
                  <option key={option.value} value={option.value}>
                    {option.label}
                  </option>
                ))}
              </Select>

              <HStack>
                <Text fontSize="sm" color="gray.600">
                  Page {page} of {totalPages}
                </Text>
                <Badge colorScheme="blue" variant="subtle">
                  {jobs.length} of {total} jobs
                </Badge>
              </HStack>
            </HStack>
          </CardBody>
        </Card>

        {/* Jobs Table */}
        <Card>
          <CardBody p={0}>
            <JobsTable
              jobs={jobs}
              loading={loading}
              error={error}
              onStopJob={handleStopJob}
              onDeleteJob={handleDeleteJob}
              onViewInputs={handleViewInputs}
            />
          </CardBody>
        </Card>

        {/* Pagination */}
        {totalPages > 1 && (
          <HStack justify="center" spacing={2}>
            <Button
              size="sm"
              variant="outline"
              isDisabled={page === 1}
              onClick={() => setFilters({ ...filters, page: page - 1 })}
            >
              Previous
            </Button>
            <Text fontSize="sm" color="gray.600">
              Page {page} of {totalPages}
            </Text>
            <Button
              size="sm"
              variant="outline"
              isDisabled={page === totalPages}
              onClick={() => setFilters({ ...filters, page: page + 1 })}
            >
              Next
            </Button>
          </HStack>
        )}
        </VStack>
      </Container>

      {/* Job Inputs Modal */}
      <JobInputsModal
        isOpen={isOpen}
        onClose={onClose}
        jobInputs={jobInputs}
        loading={inputsLoading}
        error={inputsError}
      />
    </Box>
  );
};

export default Jobs;
