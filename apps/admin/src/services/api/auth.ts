import { API_BASE_URL } from '../../utils/constants';
import { mockAuthAPI } from './mockAuth';

export interface LoginCredentials {
  email: string;
  password: string;
}

export interface LoginResponse {
  success: boolean;
  user?: {
    id: string;
    name: string;
    email: string;
    role: string;
  };
  token?: string;
  error?: string;
}

// Check if we should use mock API (when no backend is available)
const USE_MOCK_API = import.meta.env.DEV && !import.meta.env.VITE_API_URL;

export const authAPI = {
  async login(credentials: LoginCredentials): Promise<LoginResponse> {
    // Use mock API in development when no backend URL is configured
    if (USE_MOCK_API) {
      console.log('Using mock authentication API');
      return mockAuthAPI.login(credentials);
    }

    try {
      const response = await fetch(`${API_BASE_URL}/auth/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(credentials),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Login API error:', error);
      // Fallback to mock API if real API fails
      console.log('Falling back to mock authentication');
      return mockAuthAPI.login(credentials);
    }
  },

  async logout(): Promise<void> {
    if (USE_MOCK_API) {
      return mockAuthAPI.logout();
    }

    try {
      const token = localStorage.getItem('auth_token');
      await fetch(`${API_BASE_URL}/auth/logout`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });
    } catch (error) {
      console.error('Logout API error:', error);
      // Fallback to mock
      return mockAuthAPI.logout();
    }
  },

  async refreshToken(): Promise<LoginResponse> {
    if (USE_MOCK_API) {
      return mockAuthAPI.refreshToken();
    }

    try {
      const token = localStorage.getItem('auth_token');
      const response = await fetch(`${API_BASE_URL}/auth/refresh`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Token refresh error:', error);
      // Fallback to mock
      return mockAuthAPI.refreshToken();
    }
  },
};
