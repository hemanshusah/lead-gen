import React from 'react';
import { Text as ChakraText, TextProps as ChakraTextProps, Heading as ChakraHeading, HeadingProps as ChakraHeadingProps } from '@chakra-ui/react';

export interface TypographyProps extends ChakraTextProps {
  variant?: 'body' | 'caption' | 'small' | 'large';
  color?: 'primary' | 'secondary' | 'muted' | 'error' | 'success' | 'warning';
}

export interface HeadingProps extends ChakraHeadingProps {
  level?: 1 | 2 | 3 | 4 | 5 | 6;
  color?: 'primary' | 'secondary' | 'muted';
}

export const Typography: React.FC<TypographyProps> = ({
  variant = 'body',
  color = 'primary',
  children,
  ...props
}) => {
  const getVariantProps = () => {
    switch (variant) {
      case 'body':
        return { fontSize: 'md' };
      case 'caption':
        return { fontSize: 'sm', color: 'gray.500' };
      case 'small':
        return { fontSize: 'sm' };
      case 'large':
        return { fontSize: 'lg' };
      default:
        return { fontSize: 'md' };
    }
  };

  const getColorProps = () => {
    switch (color) {
      case 'primary':
        return { color: 'gray.900' };
      case 'secondary':
        return { color: 'gray.600' };
      case 'muted':
        return { color: 'gray.500' };
      case 'error':
        return { color: 'red.500' };
      case 'success':
        return { color: 'green.500' };
      case 'warning':
        return { color: 'yellow.500' };
      default:
        return { color: 'gray.900' };
    }
  };

  return (
    <ChakraText
      {...getVariantProps()}
      {...getColorProps()}
      {...props}
    >
      {children}
    </ChakraText>
  );
};

export const Heading: React.FC<HeadingProps> = ({
  level = 1,
  color = 'primary',
  children,
  ...props
}) => {
  const getSizeProps = () => {
    switch (level) {
      case 1:
        return { size: 'xl' };
      case 2:
        return { size: 'lg' };
      case 3:
        return { size: 'md' };
      case 4:
        return { size: 'sm' };
      case 5:
        return { size: 'xs' };
      case 6:
        return { size: 'xs' };
      default:
        return { size: 'xl' };
    }
  };

  const getColorProps = () => {
    switch (color) {
      case 'primary':
        return { color: 'gray.900' };
      case 'secondary':
        return { color: 'gray.600' };
      case 'muted':
        return { color: 'gray.500' };
      default:
        return { color: 'gray.900' };
    }
  };

  return (
    <ChakraHeading
      as={`h${level}` as any}
      {...getSizeProps()}
      {...getColorProps()}
      {...props}
    >
      {children}
    </ChakraHeading>
  );
};
