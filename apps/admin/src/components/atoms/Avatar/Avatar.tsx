import React from 'react';
import { Avatar as ChakraAvatar, AvatarProps as ChakraAvatarProps } from '@chakra-ui/react';

export interface AvatarProps extends ChakraAvatarProps {
  name?: string;
  src?: string;
  size?: 'xs' | 'sm' | 'md' | 'lg' | 'xl' | '2xl';
  showBorder?: boolean;
}

export const Avatar: React.FC<AvatarProps> = ({
  name,
  src,
  size = 'md',
  showBorder = false,
  ...props
}) => {
  return (
    <ChakraAvatar
      name={name}
      src={src}
      size={size}
      border={showBorder ? '2px solid' : 'none'}
      borderColor="brand.500"
      {...props}
    />
  );
};
