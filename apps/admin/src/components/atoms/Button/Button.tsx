import React from 'react';
import { Button as ChakraButton, ButtonProps as ChakraButtonProps } from '@chakra-ui/react';

export interface ButtonProps extends ChakraButtonProps {
  variant?: 'primary' | 'secondary' | 'outline' | 'ghost' | 'link';
  size?: 'sm' | 'md' | 'lg';
  isLoading?: boolean;
  loadingText?: string;
}

export const Button: React.FC<ButtonProps> = ({
  variant = 'primary',
  size = 'md',
  children,
  ...props
}) => {
  const getVariantProps = () => {
    switch (variant) {
      case 'primary':
        return { colorScheme: 'brand', variant: 'solid' };
      case 'secondary':
        return { colorScheme: 'gray', variant: 'solid' };
      case 'outline':
        return { colorScheme: 'brand', variant: 'outline' };
      case 'ghost':
        return { colorScheme: 'brand', variant: 'ghost' };
      case 'link':
        return { colorScheme: 'brand', variant: 'link' };
      default:
        return { colorScheme: 'brand', variant: 'solid' };
    }
  };

  const getSizeProps = () => {
    switch (size) {
      case 'sm':
        return { size: 'sm' };
      case 'md':
        return { size: 'md' };
      case 'lg':
        return { size: 'lg' };
      default:
        return { size: 'md' };
    }
  };

  return (
    <ChakraButton
      {...getVariantProps()}
      {...getSizeProps()}
      {...props}
    >
      {children}
    </ChakraButton>
  );
};
