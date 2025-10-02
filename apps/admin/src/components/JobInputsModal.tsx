import {
  Modal,
  ModalOverlay,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalCloseButton,
  VStack,
  HStack,
  Text,
  Badge,
  Box,
  Divider,
  Code,
  Spinner,
  Alert,
  AlertIcon,
  AlertTitle,
  AlertDescription,
} from '@chakra-ui/react';
import { JobInputs } from '../types/jobs';

interface JobInputsModalProps {
  isOpen: boolean;
  onClose: () => void;
  jobInputs: JobInputs | null;
  loading: boolean;
  error: string | null;
}

const JobInputsModal: React.FC<JobInputsModalProps> = ({
  isOpen,
  onClose,
  jobInputs,
  loading,
  error,
}) => {
  const formatValue = (value: any): string => {
    if (typeof value === 'object') {
      return JSON.stringify(value, null, 2);
    }
    return String(value);
  };

  const renderObjectData = (data: Record<string, any>, title: string) => {
    const entries = Object.entries(data);
    if (entries.length === 0) {
      return (
        <Box>
          <Text fontSize="sm" fontWeight="semibold" color="gray.600" mb={2}>
            {title}
          </Text>
          <Text fontSize="sm" color="gray.500" fontStyle="italic">
            No data available
          </Text>
        </Box>
      );
    }

    return (
      <Box>
        <Text fontSize="sm" fontWeight="semibold" color="gray.600" mb={2}>
          {title}
        </Text>
        <VStack spacing={2} align="stretch">
          {entries.map(([key, value]) => (
            <Box key={key} p={3} bg="gray.50" borderRadius="md">
              <HStack justify="space-between" mb={1}>
                <Text fontSize="xs" fontWeight="medium" color="gray.700">
                  {key}
                </Text>
                <Badge size="sm" colorScheme="blue">
                  {typeof value}
                </Badge>
              </HStack>
              <Code fontSize="xs" p={2} bg="white" borderRadius="sm" display="block">
                {formatValue(value)}
              </Code>
            </Box>
          ))}
        </VStack>
      </Box>
    );
  };

  return (
    <Modal isOpen={isOpen} onClose={onClose} size="xl">
      <ModalOverlay />
      <ModalContent maxH="80vh">
        <ModalHeader>
          <HStack>
            <Text>Job Inputs</Text>
            {jobInputs && (
              <Badge colorScheme="blue" fontSize="xs">
                ID: {jobInputs.jobId}
              </Badge>
            )}
          </HStack>
        </ModalHeader>
        <ModalCloseButton />
        <ModalBody pb={6}>
          {loading && (
            <Box textAlign="center" py={8}>
              <Spinner size="lg" />
              <Text mt={4} color="gray.600">
                Loading job inputs...
              </Text>
            </Box>
          )}

          {error && (
            <Alert status="error" mb={4}>
              <AlertIcon />
              <Box>
                <AlertTitle>Error loading inputs!</AlertTitle>
                <AlertDescription>{error}</AlertDescription>
              </Box>
            </Alert>
          )}

          {jobInputs && !loading && (
            <VStack spacing={6} align="stretch">
              <Box>
                <HStack justify="space-between" mb={2}>
                  <Text fontSize="sm" fontWeight="semibold" color="gray.600">
                    Created
                  </Text>
                  <Text fontSize="sm" color="gray.500">
                    {new Date(jobInputs.createdAt).toLocaleString()}
                  </Text>
                </HStack>
                <HStack justify="space-between">
                  <Text fontSize="sm" fontWeight="semibold" color="gray.600">
                    Updated
                  </Text>
                  <Text fontSize="sm" color="gray.500">
                    {new Date(jobInputs.updatedAt).toLocaleString()}
                  </Text>
                </HStack>
              </Box>

              <Divider />

              {renderObjectData(jobInputs.parameters, 'Parameters')}
              
              <Divider />
              
              {renderObjectData(jobInputs.searchCriteria, 'Search Criteria')}
              
              <Divider />
              
              {renderObjectData(jobInputs.filters, 'Filters')}
            </VStack>
          )}
        </ModalBody>
      </ModalContent>
    </Modal>
  );
};

export default JobInputsModal;
