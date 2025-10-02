import {
  Box,
  VStack,
  HStack,
  Text,
  FormControl,
  FormLabel,
  FormErrorMessage,
  FormHelperText,
  Input,
  NumberInput,
  NumberInputField,
  NumberInputStepper,
  NumberIncrementStepper,
  NumberDecrementStepper,
  Switch,
  Select,
  Textarea,
  Tag,
  TagLabel,
  TagCloseButton,
  Button,
  Divider,
  Card,
  CardBody,
  Heading,
  Badge,
  Alert,
  AlertIcon,
} from '@chakra-ui/react';
import { useState } from 'react';
import { DataSource, DataSourceParam, JobParams } from '../types/datasources';

interface DynamicParamsFormProps {
  selectedSources: DataSource[];
  params: { [sourceId: number]: JobParams };
  onParamsChange: (sourceId: number, params: JobParams) => void;
  errors: { [sourceId: number]: { [paramName: string]: string } };
}

const DynamicParamsForm: React.FC<DynamicParamsFormProps> = ({
  selectedSources,
  params,
  onParamsChange,
  errors,
}) => {
  const [arrayInputs, setArrayInputs] = useState<{ [key: string]: string }>({});

  const handleParamChange = (sourceId: number, paramName: string, value: any) => {
    const currentParams = params[sourceId] || {};
    onParamsChange(sourceId, {
      ...currentParams,
      [paramName]: value,
    });
  };

  const handleArrayAdd = (sourceId: number, paramName: string, value: string) => {
    if (!value.trim()) return;
    
    const currentParams = params[sourceId] || {};
    const currentArray = (currentParams[paramName] as string[]) || [];
    const newArray = [...currentArray, value.trim()];
    
    handleParamChange(sourceId, paramName, newArray);
    setArrayInputs(prev => ({ ...prev, [`${sourceId}-${paramName}`]: '' }));
  };

  const handleArrayRemove = (sourceId: number, paramName: string, index: number) => {
    const currentParams = params[sourceId] || {};
    const currentArray = (currentParams[paramName] as string[]) || [];
    const newArray = currentArray.filter((_, i) => i !== index);
    handleParamChange(sourceId, paramName, newArray);
  };

  const renderField = (source: DataSource, param: DataSourceParam) => {
    const sourceId = source.id;
    const paramName = param.name;
    const currentValue = params[sourceId]?.[paramName];
    const error = errors[sourceId]?.[paramName];
    const fieldKey = `${sourceId}-${paramName}`;

    const commonProps = {
      isInvalid: !!error,
      isRequired: param.required,
    };

    const handleChange = (value: any) => {
      handleParamChange(sourceId, paramName, value);
    };

    // Handle enum values
    if (param.validation?.enum) {
      return (
        <FormControl key={fieldKey} {...commonProps}>
          <FormLabel>{param.name}</FormLabel>
          <Select
            value={currentValue as string || ''}
            onChange={(e) => handleChange(e.target.value)}
            placeholder={`Select ${param.name}`}
          >
            {param.validation.enum.map((option) => (
              <option key={option} value={option}>
                {option}
              </option>
            ))}
          </Select>
          {param.description && (
            <FormHelperText>{param.description}</FormHelperText>
          )}
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Handle array types
    if (param.type === 'array') {
      const arrayValue = (currentValue as string[]) || [];
      const inputKey = `${sourceId}-${paramName}`;
      const inputValue = arrayInputs[inputKey] || '';

      return (
        <FormControl key={fieldKey} {...commonProps}>
          <FormLabel>{param.name}</FormLabel>
          <VStack spacing={2} align="stretch">
            <HStack>
              <Input
                value={inputValue}
                onChange={(e) => setArrayInputs(prev => ({ ...prev, [inputKey]: e.target.value }))}
                placeholder={`Add ${param.name}`}
                onKeyPress={(e) => {
                  if (e.key === 'Enter') {
                    e.preventDefault();
                    handleArrayAdd(sourceId, paramName, inputValue);
                  }
                }}
              />
              <Button
                size="sm"
                onClick={() => handleArrayAdd(sourceId, paramName, inputValue)}
                isDisabled={!inputValue.trim()}
              >
                Add
              </Button>
            </HStack>
            {arrayValue.length > 0 && (
              <HStack spacing={2} wrap="wrap">
                {arrayValue.map((item, index) => (
                  <Tag key={index} size="md" colorScheme="blue">
                    <TagLabel>{item}</TagLabel>
                    <TagCloseButton onClick={() => handleArrayRemove(sourceId, paramName, index)} />
                  </Tag>
                ))}
              </HStack>
            )}
          </VStack>
          {param.description && (
            <FormHelperText>{param.description}</FormHelperText>
          )}
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Handle boolean types
    if (param.type === 'boolean') {
      return (
        <FormControl key={fieldKey} {...commonProps}>
          <HStack justify="space-between">
            <Box>
              <FormLabel mb={0}>{param.name}</FormLabel>
              {param.description && (
                <FormHelperText mt={0}>{param.description}</FormHelperText>
              )}
            </Box>
            <Switch
              isChecked={currentValue as boolean || false}
              onChange={(e) => handleChange(e.target.checked)}
            />
          </HStack>
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Handle number types
    if (param.type === 'number' || param.type === 'integer') {
      return (
        <FormControl key={fieldKey} {...commonProps}>
          <FormLabel>{param.name}</FormLabel>
          <NumberInput
            value={currentValue as number || ''}
            onChange={(_, value) => handleChange(value)}
            min={param.validation?.min}
            max={param.validation?.max}
          >
            <NumberInputField />
            <NumberInputStepper>
              <NumberIncrementStepper />
              <NumberDecrementStepper />
            </NumberInputStepper>
          </NumberInput>
          {param.description && (
            <FormHelperText>{param.description}</FormHelperText>
          )}
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Handle date/datetime types
    if (param.type === 'date' || param.type === 'datetime') {
      const inputType = param.type === 'date' ? 'date' : 'datetime-local';
      return (
        <FormControl key={fieldKey} {...commonProps}>
          <FormLabel>{param.name}</FormLabel>
          <Input
            type={inputType}
            value={currentValue as string || ''}
            onChange={(e) => handleChange(e.target.value)}
          />
          {param.description && (
            <FormHelperText>{param.description}</FormHelperText>
          )}
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Handle email/url types with pattern validation
    if (param.type === 'email' || param.type === 'url') {
      const inputType = param.type;
      return (
        <FormControl key={fieldKey} {...commonProps}>
          <FormLabel>{param.name}</FormLabel>
          <Input
            type={inputType}
            value={currentValue as string || ''}
            onChange={(e) => handleChange(e.target.value)}
            pattern={param.validation?.pattern}
          />
          {param.description && (
            <FormHelperText>{param.description}</FormHelperText>
          )}
          {param.validation?.pattern && (
            <FormHelperText fontSize="xs">
              Pattern: {param.validation.pattern}
            </FormHelperText>
          )}
          <FormErrorMessage>{error}</FormErrorMessage>
        </FormControl>
      );
    }

    // Default to text input for string and unknown types
    const isTextarea = param.description?.toLowerCase().includes('description') || 
                       param.description?.toLowerCase().includes('note') ||
                       param.name.toLowerCase().includes('description');

    return (
      <FormControl key={fieldKey} {...commonProps}>
        <FormLabel>{param.name}</FormLabel>
        {isTextarea ? (
          <Textarea
            value={currentValue as string || ''}
            onChange={(e) => handleChange(e.target.value)}
            rows={3}
            minLength={param.validation?.min}
            maxLength={param.validation?.max}
          />
        ) : (
          <Input
            type="text"
            value={currentValue as string || ''}
            onChange={(e) => handleChange(e.target.value)}
            minLength={param.validation?.min}
            maxLength={param.validation?.max}
            pattern={param.validation?.pattern}
          />
        )}
        {param.description && (
          <FormHelperText>{param.description}</FormHelperText>
        )}
        {param.validation?.pattern && (
          <FormHelperText fontSize="xs">
            Pattern: {param.validation.pattern}
          </FormHelperText>
        )}
        <FormErrorMessage>{error}</FormErrorMessage>
      </FormControl>
    );
  };

  if (selectedSources.length === 0) {
    return (
      <Alert status="info">
        <AlertIcon />
        <Text>Please select at least one data source to configure parameters.</Text>
      </Alert>
    );
  }

  return (
    <VStack spacing={6} align="stretch">
      {selectedSources.map((source) => (
        <Card key={source.id}>
          <CardBody>
            <VStack spacing={4} align="stretch">
              <Box>
                <HStack justify="space-between" mb={2}>
                  <Heading size="md">{source.name}</Heading>
                  <Badge colorScheme="blue" variant="subtle">
                    {source.params.length} parameter{source.params.length !== 1 ? 's' : ''}
                  </Badge>
                </HStack>
                <Text fontSize="sm" color="gray.600">
                  {source.description}
                </Text>
              </Box>

              <Divider />

              <VStack spacing={4} align="stretch">
                {source.params.map((param) => renderField(source, param))}
              </VStack>
            </VStack>
          </CardBody>
        </Card>
      ))}
    </VStack>
  );
};

export default DynamicParamsForm;
