import React from 'react';
import { Badge as ChakraBadge, BadgeProps as ChakraBadgeProps } from '@chakra-ui/react';

export interface BadgeProps extends ChakraBadgeProps {
  variant?: 'solid' | 'subtle' | 'outline';
  colorScheme?: 'blue' | 'green' | 'red' | 'yellow' | 'purple' | 'gray';
  size?: 'sm' | 'md' | 'lg';
}

export const Badge: React.FC<BadgeProps> = ({
  variant = 'subtle',
  colorScheme = 'blue',
  size = 'md',
  children,
  ...props
}) => {
  return (
    <ChakraBadge
      variant={variant}
      colorScheme={colorScheme}
      size={size}
      {...props}
    >
      {children}
    </ChakraBadge>
  );
};
