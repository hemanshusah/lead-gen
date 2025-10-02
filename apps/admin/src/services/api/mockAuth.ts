import { LoginCredentials, LoginResponse } from './auth';

// Mock API for development when no backend is available
export const mockAuthAPI = {
  async login(credentials: LoginCredentials): Promise<LoginResponse> {
    // Simulate API delay
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // Mock authentication logic
    if (credentials.email === 'admin@example.com' && credentials.password === 'password') {
      return {
        success: true,
        user: {
          id: '1',
          name: 'Admin User',
          email: 'admin@example.com',
          role: 'admin',
        },
        token: 'mock-jwt-token-12345',
      };
    } else if (credentials.email === 'user@example.com' && credentials.password === 'password') {
      return {
        success: true,
        user: {
          id: '2',
          name: 'Regular User',
          email: 'user@example.com',
          role: 'user',
        },
        token: 'mock-jwt-token-67890',
      };
    } else {
      return {
        success: false,
        error: 'Invalid credentials',
      };
    }
  },

  async logout(): Promise<void> {
    // Simulate API delay
    await new Promise(resolve => setTimeout(resolve, 500));
    console.log('Mock logout successful');
  },

  async refreshToken(): Promise<LoginResponse> {
    // Simulate API delay
    await new Promise(resolve => setTimeout(resolve, 500));
    
    const token = localStorage.getItem('auth_token');
    if (token && token.startsWith('mock-jwt-token')) {
      return {
        success: true,
        user: {
          id: '1',
          name: 'Admin User',
          email: 'admin@example.com',
          role: 'admin',
        },
        token: 'mock-jwt-token-refreshed',
      };
    }
    
    return {
      success: false,
      error: 'Invalid token',
    };
  },
};
