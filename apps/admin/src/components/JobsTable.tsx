import {
  Table,
  Thead,
  Tbody,
  Tr,
  Th,
  Td,
  Badge,
  HStack,
  VStack,
  IconButton,
  Menu,
  MenuButton,
  MenuList,
  MenuItem,
  useToast,
  Text,
  Box,
  Spinner,
  Alert,
  AlertIcon,
  AlertTitle,
  AlertDescription,
} from '@chakra-ui/react';
import { FiMoreVertical, FiEye, FiSettings, FiSquare, FiTrash2 } from 'react-icons/fi';
import { Job, JobStatus } from '../types/jobs';
import { useNavigate } from 'react-router-dom';

interface JobsTableProps {
  jobs: Job[];
  loading: boolean;
  error: string | null;
  onStopJob: (jobId: string) => Promise<boolean>;
  onDeleteJob: (jobId: string) => Promise<boolean>;
  onViewInputs: (jobId: string) => void;
}

const JobsTable: React.FC<JobsTableProps> = ({
  jobs,
  loading,
  error,
  onStopJob,
  onDeleteJob,
  onViewInputs,
}) => {
  const navigate = useNavigate();
  const toast = useToast();

  const getStatusColor = (status: JobStatus): string => {
    const statusColors: Record<JobStatus, string> = {
      running: 'blue',
      pending: 'gray',
      verifying: 'yellow',
      updating: 'indigo',
      starting: 'slate',
      success: 'green',
      failed: 'red',
      paused: 'orange',
      stopped: 'orange',
    };
    return statusColors[status] || 'gray';
  };

  const formatDate = (dateString: string): string => {
    return new Date(dateString).toLocaleDateString('en-US', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
    });
  };

  const handleViewData = (jobId: string) => {
    navigate(`/jobs/${jobId}/data`);
  };

  const handleStopJob = async (jobId: string) => {
    const success = await onStopJob(jobId);
    if (success) {
      toast({
        title: 'Job stopped successfully',
        status: 'success',
        duration: 3000,
        isClosable: true,
      });
    } else {
      toast({
        title: 'Failed to stop job',
        status: 'error',
        duration: 3000,
        isClosable: true,
      });
    }
  };

  const handleDeleteJob = async (jobId: string) => {
    const success = await onDeleteJob(jobId);
    if (success) {
      toast({
        title: 'Job deleted successfully',
        status: 'success',
        duration: 3000,
        isClosable: true,
      });
    } else {
      toast({
        title: 'Failed to delete job',
        status: 'error',
        duration: 3000,
        isClosable: true,
      });
    }
  };

  if (loading) {
    return (
      <Box textAlign="center" py={8}>
        <Spinner size="lg" />
        <Text mt={4} color="gray.600">
          Loading jobs...
        </Text>
      </Box>
    );
  }

  if (error) {
    return (
      <Alert status="error">
        <AlertIcon />
        <Box>
          <AlertTitle>Error loading jobs!</AlertTitle>
          <AlertDescription>{error}</AlertDescription>
        </Box>
      </Alert>
    );
  }

  if (jobs.length === 0) {
    return (
      <Box textAlign="center" py={12}>
        <Text fontSize="lg" color="gray.500" mb={4}>
          No jobs found
        </Text>
        <Text fontSize="sm" color="gray.400">
          Create your first job to get started
        </Text>
      </Box>
    );
  }

  return (
    <Table variant="simple" size="sm">
      <Thead>
        <Tr>
          <Th>Job ID</Th>
          <Th>Title</Th>
          <Th>Sources</Th>
          <Th>Records</Th>
          <Th>Status</Th>
          <Th>Created</Th>
          <Th>Actions</Th>
        </Tr>
      </Thead>
      <Tbody>
        {jobs.map((job) => (
          <Tr key={job.id}>
            <Td>
              <Text fontSize="sm" fontFamily="mono" color="gray.600">
                {job.id.slice(0, 8)}...
              </Text>
            </Td>
            <Td>
              <Text fontWeight="medium" fontSize="sm">
                {job.title}
              </Text>
            </Td>
            <Td>
              <HStack spacing={1} flexWrap="wrap">
                {job.sources.map((source, index) => (
                  <Badge key={index} size="sm" colorScheme="blue" variant="subtle">
                    {source}
                  </Badge>
                ))}
              </HStack>
            </Td>
            <Td>
              <Text fontSize="sm" color="gray.600">
                {job.recordsScraped.toLocaleString()}
              </Text>
            </Td>
            <Td>
              <Badge colorScheme={getStatusColor(job.status)} size="sm">
                {job.status}
              </Badge>
            </Td>
            <Td>
              <VStack align="start" spacing={0}>
                <Text fontSize="xs" color="gray.500">
                  {formatDate(job.createdAt)}
                </Text>
                {job.lastRun && (
                  <Text fontSize="xs" color="gray.400">
                    Last: {formatDate(job.lastRun)}
                  </Text>
                )}
              </VStack>
            </Td>
            <Td>
              <Menu>
                <MenuButton
                  as={IconButton}
                  icon={<FiMoreVertical />}
                  variant="ghost"
                  size="sm"
                  aria-label="Job actions"
                />
                <MenuList>
                  <MenuItem
                    icon={<FiEye />}
                    onClick={() => handleViewData(job.id)}
                  >
                    View Data
                  </MenuItem>
                  <MenuItem
                    icon={<FiSettings />}
                    onClick={() => onViewInputs(job.id)}
                  >
                    View Inputs
                  </MenuItem>
                  {job.status === 'running' && (
                    <MenuItem
                      icon={<FiSquare />}
                      onClick={() => handleStopJob(job.id)}
                      color="orange.600"
                    >
                      Stop Job
                    </MenuItem>
                  )}
                  <MenuItem
                    icon={<FiTrash2 />}
                    onClick={() => handleDeleteJob(job.id)}
                    color="red.600"
                  >
                    Delete Job
                  </MenuItem>
                </MenuList>
              </Menu>
            </Td>
          </Tr>
        ))}
      </Tbody>
    </Table>
  );
};

export default JobsTable;
