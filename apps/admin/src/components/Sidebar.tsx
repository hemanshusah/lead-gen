import {
  Box,
  VStack,
  HStack,
  Text,
  Icon,
  useColorModeValue,
  Divider,
} from '@chakra-ui/react';
import { NavLink } from 'react-router-dom';
import {
  FiHome,
  FiUsers,
  FiBarChart3,
  FiSettings,
  FiLogOut,
} from 'react-icons/fi';
import { useAppDispatch, useAppSelector } from '../store/hooks';
import { logout } from '../store/slices/authSlice';

interface NavItemProps {
  icon: any;
  label: string;
  to: string;
}

const NavItem: React.FC<NavItemProps> = ({ icon, label, to }) => {
  const activeColor = useColorModeValue('brand.500', 'brand.200');
  const inactiveColor = useColorModeValue('gray.600', 'gray.300');
  const hoverBg = useColorModeValue('gray.100', 'gray.700');

  return (
    <NavLink
      to={to}
      style={({ isActive }) => ({
        color: isActive ? activeColor : inactiveColor,
        backgroundColor: isActive ? hoverBg : 'transparent',
        borderRadius: '8px',
        padding: '8px 12px',
        display: 'flex',
        alignItems: 'center',
        textDecoration: 'none',
        transition: 'all 0.2s',
      })}
    >
      {({ isActive }) => (
        <HStack spacing={3}>
          <Icon as={icon} boxSize={5} />
          <Text fontWeight={isActive ? 'semibold' : 'normal'}>{label}</Text>
        </HStack>
      )}
    </NavLink>
  );
};

const Sidebar: React.FC = () => {
  const dispatch = useAppDispatch();
  const { user } = useAppSelector((state) => state.auth);
  const bg = useColorModeValue('white', 'gray.800');
  const borderColor = useColorModeValue('gray.200', 'gray.700');

  const handleLogout = () => {
    dispatch(logout());
  };

  const navItems = [
    { icon: FiHome, label: 'Dashboard', to: '/dashboard' },
    { icon: FiUsers, label: 'Users', to: '/dashboard/users' },
    { icon: FiBarChart3, label: 'Analytics', to: '/dashboard/analytics' },
    { icon: FiSettings, label: 'Settings', to: '/dashboard/settings' },
  ];

  return (
    <Box
      w="250px"
      h="100vh"
      bg={bg}
      borderRight="1px"
      borderColor={borderColor}
      p={4}
      display="flex"
      flexDirection="column"
    >
      {/* Logo */}
      <Box mb={8}>
        <Text fontSize="xl" fontWeight="bold" color="brand.500">
          Admin Panel
        </Text>
      </Box>

      {/* Navigation */}
      <VStack spacing={2} align="stretch" flex="1">
        {navItems.map((item) => (
          <NavItem
            key={item.to}
            icon={item.icon}
            label={item.label}
            to={item.to}
          />
        ))}
      </VStack>

      <Divider my={4} />

      {/* User Info & Logout */}
      <VStack spacing={3} align="stretch">
        <Box>
          <Text fontSize="sm" fontWeight="semibold" color="gray.600">
            {user?.name}
          </Text>
          <Text fontSize="xs" color="gray.500">
            {user?.email}
          </Text>
        </Box>
        <Box
          as="button"
          onClick={handleLogout}
          p={2}
          borderRadius="md"
          _hover={{ bg: 'red.50', color: 'red.600' }}
          transition="all 0.2s"
        >
          <HStack spacing={3}>
            <Icon as={FiLogOut} boxSize={4} />
            <Text fontSize="sm">Logout</Text>
          </HStack>
        </Box>
      </VStack>
    </Box>
  );
};

export default Sidebar;
