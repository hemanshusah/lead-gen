import { useAppSelector, useAppDispatch } from '../store/hooks';
import { loginStart, loginSuccess, loginFailure, logout } from '../store/slices/authSlice';
import { authAPI } from '../services/api';

export const useAuth = () => {
  const dispatch = useAppDispatch();
  const { user, isAuthenticated, isLoading } = useAppSelector((state) => state.auth);

  const login = async (email: string, password: string) => {
    dispatch(loginStart());
    
    try {
      const response = await authAPI.login({ email, password });
      
      if (response.success && response.user) {
        // Store token if provided
        if (response.token) {
          localStorage.setItem('auth_token', response.token);
        }
        
        dispatch(loginSuccess(response.user));
        return { success: true };
      } else {
        dispatch(loginFailure());
        return { 
          success: false, 
          error: response.error || 'Invalid credentials' 
        };
      }
    } catch (error) {
      dispatch(loginFailure());
      return { 
        success: false, 
        error: error instanceof Error ? error.message : 'Login failed' 
      };
    }
  };

  const logoutUser = async () => {
    try {
      await authAPI.logout();
    } catch (error) {
      console.error('Logout error:', error);
    } finally {
      localStorage.removeItem('auth_token');
      dispatch(logout());
    }
  };

  return {
    user,
    isAuthenticated,
    isLoading,
    login,
    logout: logoutUser,
  };
};
