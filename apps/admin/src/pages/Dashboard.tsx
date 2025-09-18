import {
  Box,
  Grid,
  GridItem,
  Stat,
  StatLabel,
  StatNumber,
  StatHelpText,
  StatArrow,
  Card,
  CardBody,
  Heading,
  Text,
  VStack,
  HStack,
  Icon,
  Progress,
  Table,
  Thead,
  Tbody,
  Tr,
  Th,
  Td,
  Badge,
} from '@chakra-ui/react';
import {
  FiUsers,
  FiDollarSign,
  FiTrendingUp,
  FiActivity,
} from 'react-icons/fi';

const Dashboard: React.FC = () => {
  const stats = [
    {
      title: 'Total Users',
      value: '2,543',
      change: '+12%',
      changeType: 'increase' as const,
      icon: FiUsers,
      color: 'blue',
    },
    {
      title: 'Revenue',
      value: '$45,231',
      change: '+8.2%',
      changeType: 'increase' as const,
      icon: FiDollarSign,
      color: 'green',
    },
    {
      title: 'Growth',
      value: '23.1%',
      change: '+2.1%',
      changeType: 'increase' as const,
      icon: FiTrendingUp,
      color: 'purple',
    },
    {
      title: 'Active Users',
      value: '1,234',
      change: '-2.1%',
      changeType: 'decrease' as const,
      icon: FiActivity,
      color: 'orange',
    },
  ];

  const recentActivities = [
    { id: 1, user: 'John Doe', action: 'Created new account', time: '2 minutes ago', status: 'success' },
    { id: 2, user: 'Jane Smith', action: 'Updated profile', time: '5 minutes ago', status: 'info' },
    { id: 3, user: 'Bob Johnson', action: 'Made a purchase', time: '10 minutes ago', status: 'success' },
    { id: 4, user: 'Alice Brown', action: 'Requested support', time: '15 minutes ago', status: 'warning' },
  ];

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'success': return 'green';
      case 'warning': return 'yellow';
      case 'info': return 'blue';
      default: return 'gray';
    }
  };

  return (
    <Box>
      <VStack spacing={6} align="stretch">
        {/* Page Header */}
        <Box>
          <Heading size="lg" mb={2}>Dashboard Overview</Heading>
          <Text color="gray.600">Welcome to your admin dashboard</Text>
        </Box>

        {/* Stats Grid */}
        <Grid templateColumns={{ base: '1fr', md: 'repeat(2, 1fr)', lg: 'repeat(4, 1fr)' }} gap={6}>
          {stats.map((stat, index) => (
            <GridItem key={index}>
              <Card>
                <CardBody>
                  <Stat>
                    <HStack justify="space-between" mb={2}>
                      <StatLabel color="gray.600">{stat.title}</StatLabel>
                      <Icon as={stat.icon} boxSize={6} color={`${stat.color}.500`} />
                    </HStack>
                    <StatNumber fontSize="2xl" fontWeight="bold">
                      {stat.value}
                    </StatNumber>
                    <StatHelpText>
                      <StatArrow type={stat.changeType} />
                      {stat.change} from last month
                    </StatHelpText>
                  </Stat>
                </CardBody>
              </Card>
            </GridItem>
          ))}
        </Grid>

        {/* Charts and Tables */}
        <Grid templateColumns={{ base: '1fr', lg: '2fr 1fr' }} gap={6}>
          {/* Recent Activity */}
          <GridItem>
            <Card>
              <CardBody>
                <Heading size="md" mb={4}>Recent Activity</Heading>
                <Table variant="simple" size="sm">
                  <Thead>
                    <Tr>
                      <Th>User</Th>
                      <Th>Action</Th>
                      <Th>Time</Th>
                      <Th>Status</Th>
                    </Tr>
                  </Thead>
                  <Tbody>
                    {recentActivities.map((activity) => (
                      <Tr key={activity.id}>
                        <Td fontWeight="medium">{activity.user}</Td>
                        <Td>{activity.action}</Td>
                        <Td color="gray.500">{activity.time}</Td>
                        <Td>
                          <Badge colorScheme={getStatusColor(activity.status)} size="sm">
                            {activity.status}
                          </Badge>
                        </Td>
                      </Tr>
                    ))}
                  </Tbody>
                </Table>
              </CardBody>
            </Card>
          </GridItem>

          {/* Quick Stats */}
          <GridItem>
            <VStack spacing={6} align="stretch">
              <Card>
                <CardBody>
                  <Heading size="md" mb={4}>System Performance</Heading>
                  <VStack spacing={4} align="stretch">
                    <Box>
                      <HStack justify="space-between" mb={2}>
                        <Text fontSize="sm" color="gray.600">CPU Usage</Text>
                        <Text fontSize="sm" fontWeight="medium">45%</Text>
                      </HStack>
                      <Progress value={45} colorScheme="blue" size="sm" />
                    </Box>
                    <Box>
                      <HStack justify="space-between" mb={2}>
                        <Text fontSize="sm" color="gray.600">Memory Usage</Text>
                        <Text fontSize="sm" fontWeight="medium">67%</Text>
                      </HStack>
                      <Progress value={67} colorScheme="green" size="sm" />
                    </Box>
                    <Box>
                      <HStack justify="space-between" mb={2}>
                        <Text fontSize="sm" color="gray.600">Disk Usage</Text>
                        <Text fontSize="sm" fontWeight="medium">23%</Text>
                      </HStack>
                      <Progress value={23} colorScheme="purple" size="sm" />
                    </Box>
                  </VStack>
                </CardBody>
              </Card>

              <Card>
                <CardBody>
                  <Heading size="md" mb={4}>Quick Actions</Heading>
                  <VStack spacing={3} align="stretch">
                    <Button variant="outline" size="sm" justifyContent="flex-start">
                      Add New User
                    </Button>
                    <Button variant="outline" size="sm" justifyContent="flex-start">
                      Generate Report
                    </Button>
                    <Button variant="outline" size="sm" justifyContent="flex-start">
                      System Settings
                    </Button>
                  </VStack>
                </CardBody>
              </Card>
            </VStack>
          </GridItem>
        </Grid>
      </VStack>
    </Box>
  );
};

export default Dashboard;
