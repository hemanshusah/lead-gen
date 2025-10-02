import {
  Box,
  VStack,
  HStack,
  Heading,
  Text,
  Button,
  useToast,
  Container,
  useColorModeValue,
  Divider,
  FormControl,
  FormLabel,
  Input,
} from '@chakra-ui/react';
import { FiArrowLeft, FiSave } from 'react-icons/fi';
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { DataSource, JobParams, CreateJobRequest } from '../types/datasources';
import { datasourcesApiService } from '../services/api/datasourcesApi';
import DataSourcePicker from '../components/DataSourcePicker';
import DynamicParamsForm from '../components/DynamicParamsForm';
// import ScheduleForm from '../components/ScheduleForm'; // Commented out for now

const CreateJob: React.FC = () => {
  const navigate = useNavigate();
  const toast = useToast();
  
  const [dataSources, setDataSources] = useState<DataSource[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [selectedSource, setSelectedSource] = useState<number | null>(null);
  const [jobTitle, setJobTitle] = useState<string>('');
  const [params, setParams] = useState<JobParams>({});
  // Schedule Configuration - Commented out for now
  // const [schedule, setSchedule] = useState<JobSchedule>({
  //   type: 'one_time',
  //   runAt: new Date().toISOString().slice(0, 16),
  // });
  const [submitting, setSubmitting] = useState(false);
  const [validationErrors, setValidationErrors] = useState<{
    [sourceId: number]: { [paramName: string]: string };
  }>({});
  // const [scheduleErrors, setScheduleErrors] = useState<{ [key: string]: string }>({});

  const bg = useColorModeValue('gray.50', 'gray.900');
  const headerBg = useColorModeValue('white', 'gray.800');
  const borderColor = useColorModeValue('gray.200', 'gray.700');

  useEffect(() => {
    loadDataSources();
  }, []);

  const loadDataSources = async () => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await datasourcesApiService.getDataSources();
      if (response.success) {
        setDataSources(response.data);
      } else {
        setError(response.message || 'Failed to load data sources');
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Failed to load data sources');
    } finally {
      setLoading(false);
    }
  };

  const handleSourceSelection = (sourceId: number | null) => {
    setSelectedSource(sourceId);
    
    // Clear parameters when source changes
    if (sourceId !== selectedSource) {
      setParams({});
    }
    
    // Clear validation errors when source changes
    if (sourceId !== selectedSource) {
      setValidationErrors({});
    }
  };

  const handleParamsChange = (newParams: JobParams) => {
    setParams(newParams);
    
    // Clear validation errors
    setValidationErrors({});
  };

  const validateForm = (): boolean => {
    let isValid = true;
    const newErrors: { [sourceId: number]: { [paramName: string]: string } } = {};
    // const newScheduleErrors: { [key: string]: string } = {}; // Commented out for now

    // Validate source selection
    if (!selectedSource) {
      toast({
        title: 'Validation Error',
        description: 'Please select a data source',
        status: 'error',
        duration: 3000,
        isClosable: true,
      });
      return false;
    }

    // Validate job title
    if (!jobTitle.trim()) {
      toast({
        title: 'Validation Error',
        description: 'Please enter a job title',
        status: 'error',
        duration: 3000,
        isClosable: true,
      });
      return false;
    }

    // Validate parameters for selected source
    if (selectedSource) {
      const source = dataSources.find(s => s.id === selectedSource);
      if (source) {
        const sourceErrors: { [paramName: string]: string } = {};

        source.params.forEach(param => {
          const value = params[param.name];
          
          // Check required fields
          if (param.required && (value === undefined || value === null || value === '')) {
            sourceErrors[param.name] = `${param.name} is required`;
            isValid = false;
          }

          // Validate based on type and validation rules
          if (value !== undefined && value !== null && value !== '') {
            // String length validation
            if (param.type === 'string' && typeof value === 'string') {
              if (param.validation?.min && value.length < param.validation.min) {
                sourceErrors[param.name] = `Minimum length is ${param.validation.min}`;
                isValid = false;
              }
              if (param.validation?.max && value.length > param.validation.max) {
                sourceErrors[param.name] = `Maximum length is ${param.validation.max}`;
                isValid = false;
              }
            }

            // Number validation
            if ((param.type === 'number' || param.type === 'integer') && typeof value === 'number') {
              if (param.validation?.min && value < param.validation.min) {
                sourceErrors[param.name] = `Minimum value is ${param.validation.min}`;
                isValid = false;
              }
              if (param.validation?.max && value > param.validation.max) {
                sourceErrors[param.name] = `Maximum value is ${param.validation.max}`;
                isValid = false;
              }
            }

            // Enum validation
            if (param.validation?.enum && !param.validation.enum.includes(value as string)) {
              sourceErrors[param.name] = `Must be one of: ${param.validation.enum.join(', ')}`;
              isValid = false;
            }
          }
        });

        if (Object.keys(sourceErrors).length > 0) {
          newErrors[selectedSource] = sourceErrors;
        }
      }
    }

    // Schedule validation - Commented out for now
    // if (schedule.type === 'one_time') {
    //   if (!schedule.runAt) {
    //     newScheduleErrors.runAt = 'Run date and time is required';
    //     isValid = false;
    //   } else {
    //     const runDate = new Date(schedule.runAt);
    //     if (runDate <= new Date()) {
    //       newScheduleErrors.runAt = 'Run time must be in the future';
    //       isValid = false;
    //     }
    //   }
    // } else if (schedule.type === 'recurring') {
    //   if (!schedule.recurring?.time) {
    //     newScheduleErrors.time = 'Time is required for recurring jobs';
    //     isValid = false;
    //   }
    //   
    //   if (schedule.recurring?.preset === 'weekly' && (!schedule.recurring.daysOfWeek || schedule.recurring.daysOfWeek.length === 0)) {
    //     newScheduleErrors.daysOfWeek = 'At least one day of the week must be selected';
    //     isValid = false;
    //   }
    //   
    //   if (schedule.recurring?.preset === 'monthly' && (!schedule.recurring.dayOfMonth || schedule.recurring.dayOfMonth < 1 || schedule.recurring.dayOfMonth > 28)) {
    //     newScheduleErrors.dayOfMonth = 'Day of month must be between 1 and 28';
    //     isValid = false;
    //   }
    // }

    setValidationErrors(newErrors);
    // setScheduleErrors(newScheduleErrors);
    return isValid;
  };

  const handleSubmit = async () => {
    if (!validateForm()) {
      return;
    }

    setSubmitting(true);
    
    try {
      const selectedDataSource = dataSources.find(source => source.id === selectedSource);
      
      if (!selectedDataSource) {
        throw new Error('Selected data source not found');
      }
      
      const jobData: CreateJobRequest = {
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        // schedule, // Commented out for now
        jobs: [{
          sourceId: selectedDataSource.id.toString(),
          title: jobTitle.trim(),
          description: `Scraping job for ${selectedDataSource.name}`,
          params: params,
        }],
      };

      const response = await datasourcesApiService.createJobs(jobData);
      
      if (response.success) {
        const createdCount = response.data?.createdCount || 0;
        const failedCount = response.data?.failedCount || 0;
        
        if (failedCount > 0) {
          // Partial success - some jobs failed
          toast({
            title: 'Jobs Created with Issues',
            description: `Created ${createdCount} job(s), ${failedCount} failed. Check the details for more information.`,
            status: 'warning',
            duration: 8000,
            isClosable: true,
          });
        } else {
          // Complete success
          toast({
            title: 'Jobs Created Successfully',
            description: `Created ${createdCount} job(s) successfully`,
            status: 'success',
            duration: 5000,
            isClosable: true,
          });
        }
        
        navigate('/jobs');
      } else {
        toast({
          title: 'Failed to Create Jobs',
          description: response.message || 'An error occurred while creating jobs',
          status: 'error',
          duration: 5000,
          isClosable: true,
        });
      }
    } catch (err) {
      console.error('Error creating jobs:', err);
      toast({
        title: 'Error Creating Jobs',
        description: err instanceof Error ? err.message : 'An unexpected error occurred',
        status: 'error',
        duration: 5000,
        isClosable: true,
      });
    } finally {
      setSubmitting(false);
    }
  };

  const handleCancel = () => {
    navigate('/jobs');
  };

  return (
    <Box minH="100vh" bg={bg}>
      {/* Header */}
      <Box bg={headerBg} borderBottom="1px" borderColor={borderColor} px={6} py={4}>
        <Container maxW="7xl">
          <HStack spacing={4}>
            <Button
              leftIcon={<FiArrowLeft />}
              onClick={handleCancel}
              variant="ghost"
              size="sm"
            >
              Back to Jobs
            </Button>
            <Divider orientation="vertical" height="20px" />
            <Box>
              <Heading size="lg" color="brand.500" mb={1}>
                Create New Job
              </Heading>
              <Text color="gray.600" fontSize="sm">
                Configure and schedule your scraping jobs
              </Text>
            </Box>
          </HStack>
        </Container>
      </Box>

      {/* Main Content */}
      <Container maxW="7xl" py={8}>
        <VStack spacing={8} align="stretch">
          {/* Job Title */}
          <FormControl isRequired>
            <FormLabel>Job Title</FormLabel>
            <Input
              value={jobTitle}
              onChange={(e) => setJobTitle(e.target.value)}
              placeholder="Enter a descriptive title for your job"
              maxLength={100}
            />
          </FormControl>

          {/* Data Source Selection */}
          <DataSourcePicker
            dataSources={dataSources}
            selectedSources={selectedSource ? [selectedSource] : []}
            onSelectionChange={(sources) => handleSourceSelection(sources.length > 0 ? sources[0] : null)}
            loading={loading}
            error={error}
            onRetry={loadDataSources}
          />

          {/* Dynamic Parameters Form */}
          {selectedSource && (
            <DynamicParamsForm
              selectedSources={dataSources.filter(source => source.id === selectedSource)}
              params={{ [selectedSource]: params }}
              onParamsChange={(_sourceId, newParams) => handleParamsChange(newParams)}
              errors={validationErrors}
            />
          )}

          {/* Schedule Configuration - Commented out for now */}
          {/* 
          <ScheduleForm
            schedule={schedule}
            onScheduleChange={setSchedule}
            errors={scheduleErrors}
          />
          */}

          {/* Form Actions */}
          <HStack justify="flex-end" spacing={4} pt={4}>
            <Button
              onClick={handleCancel}
              variant="outline"
              isDisabled={submitting}
            >
              Cancel
            </Button>
            <Button
              onClick={handleSubmit}
              leftIcon={<FiSave />}
              colorScheme="brand"
              isLoading={submitting}
              loadingText="Creating Job..."
              isDisabled={!selectedSource || !jobTitle.trim()}
            >
              Create Job
            </Button>
          </HStack>
        </VStack>
      </Container>
    </Box>
  );
};

export default CreateJob;
