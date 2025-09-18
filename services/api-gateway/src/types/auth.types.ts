/**
 * Authentication-related types and interfaces
 */

/**
 * Login request type
 */
export interface LoginRequest {
  email: string;
  password: string;
}

/**
 * Authenticated user type (for JWT payload)
 */
export interface AuthUser {
  id: number;
  email: string;
  name: string;
  role: string;
  account_id: number;
  status: string;
  account: {
    id: number;
    name: string;
    domain?: string;
    status: string;
  };
}

/**
 * Login response type
 */
export interface LoginResponse {
  success: boolean;
  message: string;
  data: {
    user: {
      id: number;
      name: string;
      email: string;
      role: string;
      account_id: number;
      status: string;
      last_login: string;
    };
    account: {
      id: number;
      name: string;
      domain?: string;
      status: string;
      created_at: string;
      updated_at: string;
    };
    token: string;
    expires_in: number;
  };
}

/**
 * Token refresh response type
 */
export interface RefreshTokenResponse {
  success: boolean;
  message: string;
  data: {
    token: string;
    expires_in: number;
  };
}

/**
 * Logout response type
 */
export interface LogoutResponse {
  success: boolean;
  message: string;
}

/**
 * JWT payload interface
 */
export interface JwtPayload {
  sub: number; // user id
  email: string;
  name: string;
  role: string;
  account_id: number;
  status: string;
  account: {
    id: number;
    name: string;
    domain?: string;
    status: string;
  };
  iat: number; // issued at
  exp: number; // expires at
}

/**
 * Password validation result
 */
export interface PasswordValidationResult {
  isValid: boolean;
  errors: string[];
}

/**
 * User registration request (for future use)
 */
export interface RegisterRequest {
  name: string;
  email: string;
  password: string;
  account_name?: string;
}

/**
 * Password change request (for future use)
 */
export interface ChangePasswordRequest {
  current_password: string;
  new_password: string;
}

/**
 * Forgot password request (for future use)
 */
export interface ForgotPasswordRequest {
  email: string;
}

/**
 * Reset password request (for future use)
 */
export interface ResetPasswordRequest {
  token: string;
  new_password: string;
}
