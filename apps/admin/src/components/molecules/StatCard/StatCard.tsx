import React from 'react';
import { Box, HStack, VStack, Icon } from '@chakra-ui/react';
import { Typography, Heading } from '../../atoms/Typography';

export interface StatCardProps {
  title: string;
  value: string | number;
  change?: string;
  changeType?: 'increase' | 'decrease' | 'neutral';
  icon?: React.ElementType;
  color?: string;
  onClick?: () => void;
}

export const StatCard: React.FC<StatCardProps> = ({
  title,
  value,
  change,
  changeType = 'neutral',
  icon,
  color = 'brand.500',
  onClick,
}) => {
  const getChangeColor = () => {
    switch (changeType) {
      case 'increase':
        return 'green.500';
      case 'decrease':
        return 'red.500';
      default:
        return 'gray.500';
    }
  };

  return (
    <Box
      p={6}
      bg="white"
      borderRadius="lg"
      border="1px"
      borderColor="gray.200"
      _hover={{ shadow: 'md' }}
      cursor={onClick ? 'pointer' : 'default'}
      onClick={onClick}
      transition="all 0.2s"
    >
      <HStack justify="space-between" align="start" mb={4}>
        <VStack align="start" spacing={1}>
          <Typography variant="caption" color="muted">
            {title}
          </Typography>
          <Heading level={2} color="primary">
            {value}
          </Heading>
        </VStack>
        {icon && (
          <Icon as={icon} boxSize={6} color={color} />
        )}
      </HStack>
      {change && (
        <Typography
          variant="caption"
          color={getChangeColor()}
          fontWeight="medium"
        >
          {change}
        </Typography>
      )}
    </Box>
  );
};
