import { Outlet } from 'react-router-dom';
import { Box, Flex } from '@chakra-ui/react';
import Sidebar from './Sidebar';
import Header from './Header';

const Layout: React.FC = () => {
  return (
    <Flex h="100vh">
      <Sidebar />
      <Box flex="1" display="flex" flexDirection="column">
        <Header />
        <Box flex="1" p={6} overflow="auto">
          <Outlet />
        </Box>
      </Box>
    </Flex>
  );
};

export default Layout;
