import React from 'react';
import { Input as ChakraInput, InputProps as ChakraInputProps, FormControl, FormLabel, FormErrorMessage } from '@chakra-ui/react';

export interface InputProps extends ChakraInputProps {
  label?: string;
  error?: string;
  isRequired?: boolean;
  helperText?: string;
}

export const Input: React.FC<InputProps> = ({
  label,
  error,
  isRequired = false,
  helperText,
  ...props
}) => {
  return (
    <FormControl isInvalid={!!error} isRequired={isRequired}>
      {label && <FormLabel>{label}</FormLabel>}
      <ChakraInput {...props} />
      {error && <FormErrorMessage>{error}</FormErrorMessage>}
      {helperText && !error && (
        <FormErrorMessage color="gray.500" fontSize="sm">
          {helperText}
        </FormErrorMessage>
      )}
    </FormControl>
  );
};
