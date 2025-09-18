import { useState } from 'react';
import { Navigate } from 'react-router-dom';
import {
  Box,
  Button,
  FormControl,
  FormLabel,
  Input,
  VStack,
  Text,
  Heading,
  useToast,
  Container,
  Card,
  CardBody,
} from '@chakra-ui/react';
import { useAppDispatch, useAppSelector } from '../store/hooks';
import { loginStart, loginSuccess, loginFailure } from '../store/slices/authSlice';

const Login: React.FC = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const dispatch = useAppDispatch();
  const { isAuthenticated, isLoading } = useAppSelector((state) => state.auth);
  const toast = useToast();

  if (isAuthenticated) {
    return <Navigate to="/dashboard" replace />;
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    dispatch(loginStart());

    // Simulate API call
    setTimeout(() => {
      if (email === 'admin@example.com' && password === 'password') {
        dispatch(
          loginSuccess({
            id: '1',
            name: 'Admin User',
            email: 'admin@example.com',
            role: 'admin',
          })
        );
        toast({
          title: 'Login successful',
          status: 'success',
          duration: 3000,
          isClosable: true,
        });
      } else {
        dispatch(loginFailure());
        toast({
          title: 'Invalid credentials',
          description: 'Please check your email and password',
          status: 'error',
          duration: 3000,
          isClosable: true,
        });
      }
    }, 1000);
  };

  return (
    <Container maxW="md" py={20}>
      <Card>
        <CardBody p={8}>
          <VStack spacing={6}>
            <Box textAlign="center">
              <Heading size="lg" color="brand.500" mb={2}>
                Admin Panel
              </Heading>
              <Text color="gray.600">Sign in to your account</Text>
            </Box>

            <Box as="form" onSubmit={handleSubmit} w="full">
              <VStack spacing={4}>
                <FormControl isRequired>
                  <FormLabel>Email</FormLabel>
                  <Input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder="admin@example.com"
                  />
                </FormControl>

                <FormControl isRequired>
                  <FormLabel>Password</FormLabel>
                  <Input
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    placeholder="password"
                  />
                </FormControl>

                <Button
                  type="submit"
                  colorScheme="brand"
                  size="lg"
                  w="full"
                  isLoading={isLoading}
                  loadingText="Signing in..."
                >
                  Sign In
                </Button>
              </VStack>
            </Box>

            <Box textAlign="center" fontSize="sm" color="gray.500">
              <Text>Demo credentials:</Text>
              <Text>Email: admin@example.com</Text>
              <Text>Password: password</Text>
            </Box>
          </VStack>
        </CardBody>
      </Card>
    </Container>
  );
};

export default Login;
