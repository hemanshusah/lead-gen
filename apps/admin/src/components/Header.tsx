import {
  Box,
  HStack,
  Text,
  IconButton,
  useColorModeValue,
  useColorMode,
  Badge,
  Avatar,
  Menu,
  MenuButton,
  MenuList,
  MenuItem,
} from '@chakra-ui/react';
import { FiSun, FiMoon, FiBell, FiUser } from 'react-icons/fi';
import { useAppSelector } from '../store/hooks';

const Header: React.FC = () => {
  const { colorMode, toggleColorMode } = useColorMode();
  const { user } = useAppSelector((state) => state.auth);
  const bg = useColorModeValue('white', 'gray.800');
  const borderColor = useColorModeValue('gray.200', 'gray.700');

  return (
    <Box
      bg={bg}
      borderBottom="1px"
      borderColor={borderColor}
      px={6}
      py={4}
      display="flex"
      justifyContent="space-between"
      alignItems="center"
    >
      <Text fontSize="2xl" fontWeight="bold" color="gray.700">
        Welcome back, {user?.name}!
      </Text>

      <HStack spacing={4}>
        {/* Theme Toggle */}
        <IconButton
          aria-label="Toggle theme"
          icon={colorMode === 'light' ? <FiMoon /> : <FiSun />}
          onClick={toggleColorMode}
          variant="ghost"
        />

        {/* Notifications */}
        <Box position="relative">
          <IconButton
            aria-label="Notifications"
            icon={<FiBell />}
            variant="ghost"
          />
          <Badge
            position="absolute"
            top="-1"
            right="-1"
            colorScheme="red"
            borderRadius="full"
            fontSize="xs"
            px={1}
            py={0}
          >
            3
          </Badge>
        </Box>

        {/* User Menu */}
        <Menu>
          <MenuButton>
            <Avatar size="sm" name={user?.name} src="" />
          </MenuButton>
          <MenuList>
            <MenuItem icon={<FiUser />}>Profile</MenuItem>
            <MenuItem>Settings</MenuItem>
          </MenuList>
        </Menu>
      </HStack>
    </Box>
  );
};

export default Header;
