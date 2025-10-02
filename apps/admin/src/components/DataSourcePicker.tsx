import {
  Box,
  VStack,
  HStack,
  Text,
  Checkbox,
  CheckboxGroup,
  Alert,
  AlertIcon,
  AlertTitle,
  AlertDescription,
  Button,
  Spinner,
  Card,
  CardBody,
  Badge,
} from '@chakra-ui/react';
import { FiRefreshCw } from 'react-icons/fi';
import { DataSource } from '../types/datasources';

interface DataSourcePickerProps {
  dataSources: DataSource[];
  selectedSources: number[];
  onSelectionChange: (selectedIds: number[]) => void;
  loading: boolean;
  error: string | null;
  onRetry: () => void;
}

const DataSourcePicker: React.FC<DataSourcePickerProps> = ({
  dataSources,
  selectedSources,
  onSelectionChange,
  loading,
  error,
  onRetry,
}) => {
  const activeSources = dataSources.filter(source => source.is_active);

  const handleCheckboxChange = (values: string[]) => {
    const numericValues = values.map(v => parseInt(v, 10));
    onSelectionChange(numericValues);
  };

  if (loading) {
    return (
      <Box textAlign="center" py={8}>
        <Spinner size="lg" />
        <Text mt={4} color="gray.600">
          Loading data sources...
        </Text>
      </Box>
    );
  }

  if (error) {
    return (
      <Alert status="error">
        <AlertIcon />
        <Box flex="1">
          <AlertTitle>Failed to load data sources!</AlertTitle>
          <AlertDescription>{error}</AlertDescription>
        </Box>
        <Button
          leftIcon={<FiRefreshCw />}
          onClick={onRetry}
          size="sm"
          colorScheme="red"
          variant="outline"
        >
          Retry
        </Button>
      </Alert>
    );
  }

  if (activeSources.length === 0) {
    return (
      <Alert status="info">
        <AlertIcon />
        <Box>
          <AlertTitle>No active data sources</AlertTitle>
          <AlertDescription>
            There are no active data sources available. Please contact your administrator.
          </AlertDescription>
        </Box>
      </Alert>
    );
  }

  return (
    <Card>
      <CardBody>
        <VStack spacing={4} align="stretch">
          <Box>
            <Text fontSize="lg" fontWeight="semibold" mb={2}>
              Select Data Sources
            </Text>
            <Text fontSize="sm" color="gray.600" mb={4}>
              Selecting multiple sources will create multiple jobs.
            </Text>
          </Box>

          <CheckboxGroup
            value={selectedSources.map(id => id.toString())}
            onChange={handleCheckboxChange}
          >
            <VStack spacing={3} align="stretch">
              {activeSources.map((source) => (
                <Box key={source.id}>
                  <Checkbox
                    value={source.id.toString()}
                    size="lg"
                    colorScheme="brand"
                  >
                    <VStack align="start" spacing={1}>
                      <HStack>
                        <Text fontWeight="medium">{source.name}</Text>
                        <Badge colorScheme="green" size="sm">
                          Active
                        </Badge>
                      </HStack>
                      <Text fontSize="sm" color="gray.600">
                        {source.description}
                      </Text>
                      <Text fontSize="xs" color="gray.500">
                        {source.params.length} parameter{source.params.length !== 1 ? 's' : ''}
                      </Text>
                    </VStack>
                  </Checkbox>
                </Box>
              ))}
            </VStack>
          </CheckboxGroup>

          {selectedSources.length > 0 && (
            <Box p={3} bg="blue.50" borderRadius="md">
              <Text fontSize="sm" color="blue.700">
                <strong>{selectedSources.length}</strong> source{selectedSources.length !== 1 ? 's' : ''} selected
              </Text>
            </Box>
          )}
        </VStack>
      </CardBody>
    </Card>
  );
};

export default DataSourcePicker;
