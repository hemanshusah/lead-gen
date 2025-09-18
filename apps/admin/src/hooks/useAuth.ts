import { useAppSelector, useAppDispatch } from '../store/hooks';
import { loginStart, loginSuccess, loginFailure, logout } from '../store/slices/authSlice';

export const useAuth = () => {
  const dispatch = useAppDispatch();
  const { user, isAuthenticated, isLoading } = useAppSelector((state) => state.auth);

  const login = async (email: string, password: string) => {
    dispatch(loginStart());
    
    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      if (email === 'admin@example.com' && password === 'password') {
        dispatch(loginSuccess({
          id: '1',
          name: 'Admin User',
          email: 'admin@example.com',
          role: 'admin',
        }));
        return { success: true };
      } else {
        dispatch(loginFailure());
        return { success: false, error: 'Invalid credentials' };
      }
    } catch (error) {
      dispatch(loginFailure());
      return { success: false, error: 'Login failed' };
    }
  };

  const logoutUser = () => {
    dispatch(logout());
  };

  return {
    user,
    isAuthenticated,
    isLoading,
    login,
    logout: logoutUser,
  };
};
