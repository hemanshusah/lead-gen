import {
  Box,
  VStack,
  HStack,
  Text,
  FormControl,
  FormLabel,
  FormErrorMessage,
  FormHelperText,
  RadioGroup,
  Radio,
  Input,
  Select,
  Checkbox,
  CheckboxGroup,
  NumberInput,
  NumberInputField,
  NumberInputStepper,
  NumberIncrementStepper,
  NumberDecrementStepper,
  Card,
  CardBody,
  Alert,
  AlertIcon,
} from '@chakra-ui/react';
import { JobSchedule } from '../types/datasources';

interface ScheduleFormProps {
  schedule: JobSchedule;
  onScheduleChange: (schedule: JobSchedule) => void;
  errors: { [key: string]: string };
}

const ScheduleForm: React.FC<ScheduleFormProps> = ({
  schedule,
  onScheduleChange,
  errors,
}) => {
  const handleTypeChange = (type: 'one_time' | 'recurring') => {
    if (type === 'one_time') {
      onScheduleChange({
        type: 'one_time',
        runAt: schedule.runAt || new Date().toISOString().slice(0, 16),
      });
    } else {
      onScheduleChange({
        type: 'recurring',
        recurring: {
          preset: 'daily',
          time: '10:00',
        },
      });
    }
  };

  const handleOneTimeChange = (runAt: string) => {
    onScheduleChange({
      ...schedule,
      runAt,
    });
  };

  const handleRecurringChange = (field: string, value: any) => {
    onScheduleChange({
      ...schedule,
      recurring: {
        ...schedule.recurring!,
        [field]: value,
      },
    });
  };

  const getCurrentDateTime = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day}T${hours}:${minutes}`;
  };

  return (
    <Card>
      <CardBody>
        <VStack spacing={6} align="stretch">
          <Box>
            <Text fontSize="lg" fontWeight="semibold" mb={2}>
              Schedule Configuration
            </Text>
            <Text fontSize="sm" color="gray.600">
              Configure when and how often the jobs should run
            </Text>
          </Box>

          <FormControl isInvalid={!!errors.type}>
            <FormLabel>Run Type</FormLabel>
            <RadioGroup
              value={schedule.type}
              onChange={handleTypeChange}
            >
              <VStack spacing={2} align="start">
                <Radio value="one_time" colorScheme="brand">
                  <VStack align="start" spacing={0}>
                    <Text fontWeight="medium">One-time</Text>
                    <Text fontSize="sm" color="gray.600">
                      Run the job once at a specified time
                    </Text>
                  </VStack>
                </Radio>
                <Radio value="recurring" colorScheme="brand">
                  <VStack align="start" spacing={0}>
                    <Text fontWeight="medium">Recurring</Text>
                    <Text fontSize="sm" color="gray.600">
                      Run the job on a regular schedule
                    </Text>
                  </VStack>
                </Radio>
              </VStack>
            </RadioGroup>
            <FormErrorMessage>{errors.type}</FormErrorMessage>
          </FormControl>

          {schedule.type === 'one_time' && (
            <FormControl isInvalid={!!errors.runAt}>
              <FormLabel>Run Date & Time</FormLabel>
              <Input
                type="datetime-local"
                value={schedule.runAt || getCurrentDateTime()}
                onChange={(e) => handleOneTimeChange(e.target.value)}
                min={getCurrentDateTime()}
              />
              <FormHelperText>
                Select when the job should run (must be in the future)
              </FormHelperText>
              <FormErrorMessage>{errors.runAt}</FormErrorMessage>
            </FormControl>
          )}

          {schedule.type === 'recurring' && (
            <VStack spacing={4} align="stretch">
              <FormControl isInvalid={!!errors.preset}>
                <FormLabel>Recurrence Pattern</FormLabel>
                <Select
                  value={schedule.recurring?.preset || 'daily'}
                  onChange={(e) => handleRecurringChange('preset', e.target.value)}
                >
                  <option value="daily">Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
                  <option value="cron">Custom (CRON)</option>
                </Select>
                <FormErrorMessage>{errors.preset}</FormErrorMessage>
              </FormControl>

              {schedule.recurring?.preset !== 'cron' && (
                <FormControl isInvalid={!!errors.time}>
                  <FormLabel>Time of Day</FormLabel>
                  <Input
                    type="time"
                    value={schedule.recurring?.time || '10:00'}
                    onChange={(e) => handleRecurringChange('time', e.target.value)}
                  />
                  <FormHelperText>
                    Time when the job should run (24-hour format)
                  </FormHelperText>
                  <FormErrorMessage>{errors.time}</FormErrorMessage>
                </FormControl>
              )}

              {schedule.recurring?.preset === 'weekly' && (
                <FormControl isInvalid={!!errors.daysOfWeek}>
                  <FormLabel>Days of Week</FormLabel>
                  <CheckboxGroup
                    value={schedule.recurring?.daysOfWeek || []}
                    onChange={(values) => handleRecurringChange('daysOfWeek', values)}
                  >
                    <HStack spacing={4} wrap="wrap">
                      {[
                        { value: 'MON', label: 'Monday' },
                        { value: 'TUE', label: 'Tuesday' },
                        { value: 'WED', label: 'Wednesday' },
                        { value: 'THU', label: 'Thursday' },
                        { value: 'FRI', label: 'Friday' },
                        { value: 'SAT', label: 'Saturday' },
                        { value: 'SUN', label: 'Sunday' },
                      ].map((day) => (
                        <Checkbox key={day.value} value={day.value} colorScheme="brand">
                          {day.label}
                        </Checkbox>
                      ))}
                    </HStack>
                  </CheckboxGroup>
                  <FormHelperText>
                    Select which days of the week the job should run
                  </FormHelperText>
                  <FormErrorMessage>{errors.daysOfWeek}</FormErrorMessage>
                </FormControl>
              )}

              {schedule.recurring?.preset === 'monthly' && (
                <FormControl isInvalid={!!errors.dayOfMonth}>
                  <FormLabel>Day of Month</FormLabel>
                  <NumberInput
                    value={schedule.recurring?.dayOfMonth || 1}
                    onChange={(_, value) => handleRecurringChange('dayOfMonth', value)}
                    min={1}
                    max={28}
                  >
                    <NumberInputField />
                    <NumberInputStepper>
                      <NumberIncrementStepper />
                      <NumberDecrementStepper />
                    </NumberInputStepper>
                  </NumberInput>
                  <FormHelperText>
                    Day of the month to run the job (1-28)
                  </FormHelperText>
                  <FormErrorMessage>{errors.dayOfMonth}</FormErrorMessage>
                </FormControl>
              )}

              {schedule.recurring?.preset === 'cron' && (
                <FormControl isInvalid={!!errors.cron}>
                  <FormLabel>CRON Expression</FormLabel>
                  <Input
                    value={schedule.recurring?.cron || '0 30 10 * * *'}
                    onChange={(e) => handleRecurringChange('cron', e.target.value)}
                    placeholder="0 30 10 * * *"
                    fontFamily="mono"
                  />
                  <FormHelperText>
                    <Text fontSize="xs" color="gray.500">
                      Format: minute hour day month weekday
                      <br />
                      Example: 0 30 10 * * * (runs at 10:30 AM daily)
                    </Text>
                  </FormHelperText>
                  <FormErrorMessage>{errors.cron}</FormErrorMessage>
                </FormControl>
              )}
            </VStack>
          )}

          <Alert status="info" size="sm">
            <AlertIcon />
            <Text fontSize="sm">
              All times are in your local timezone. The system will handle timezone conversion automatically.
            </Text>
          </Alert>
        </VStack>
      </CardBody>
    </Card>
  );
};

export default ScheduleForm;
