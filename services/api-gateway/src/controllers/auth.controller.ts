import {inject, service} from '@loopback/core';
import {
  post,
  requestBody,
  response,
  HttpErrors,
  RestBindings,
  Request,
} from '@loopback/rest';
import {UsersRepository, AccountsRepository} from '../repositories';
import {Users, Accounts} from '../models';
import {PasswordService, JwtService} from '../services';
import {LoginRequest, LoginResponse, AuthUser} from '../types/auth.types';

/**
 * Authentication Controller
 * Handles user login, logout, and token management
 */
export class AuthController {
  constructor(
    @inject('repositories.UsersRepository')
    private usersRepository: UsersRepository,
    @inject('repositories.AccountsRepository')
    private accountsRepository: AccountsRepository,
    @service(PasswordService)
    private passwordService: PasswordService,
    @service(JwtService)
    private jwtService: JwtService,
    @inject(RestBindings.Http.REQUEST) private request: Request,
  ) {}

  /**
   * User login endpoint
   * POST /auth/login
   */
  @post('/auth/login')
  @response(200, {
    description: 'Login successful',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            data: {
              type: 'object',
              properties: {
                user: {
                  type: 'object',
                  properties: {
                    id: {type: 'number'},
                    name: {type: 'string'},
                    email: {type: 'string'},
                    role: {type: 'string'},
                    account_id: {type: 'number'},
                    status: {type: 'string'},
                    last_login: {type: 'string'},
                  },
                },
                account: {
                  type: 'object',
                  properties: {
                    id: {type: 'number'},
                    name: {type: 'string'},
                    domain: {type: 'string'},
                    status: {type: 'string'},
                    created_at: {type: 'string'},
                    updated_at: {type: 'string'},
                  },
                },
                token: {type: 'string'},
                expires_in: {type: 'number'},
              },
            },
          },
        },
      },
    },
  })
  @response(400, {
    description: 'Invalid request data',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            error: {type: 'string'},
          },
        },
      },
    },
  })
  @response(401, {
    description: 'Invalid credentials',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            error: {type: 'string'},
          },
        },
      },
    },
  })
  async login(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            required: ['email', 'password'],
            properties: {
              email: {
                type: 'string',
                format: 'email',
                description: 'User email address',
              },
              password: {
                type: 'string',
                minLength: 6,
                description: 'User password',
              },
            },
          },
        },
      },
    })
    loginRequest: LoginRequest,
  ): Promise<LoginResponse> {
    try {
      // Validate input
      if (!loginRequest.email || !loginRequest.password) {
        throw new HttpErrors.BadRequest('Email and password are required');
      }

      // Find user by email
      const user = await this.usersRepository.findOne({
        where: {email: loginRequest.email},
      });

      if (!user) {
        throw new HttpErrors.Unauthorized('Invalid email or password');
      }

      // Check if user is active
      if (user.status !== 'active') {
        throw new HttpErrors.Unauthorized('Account is not active');
      }

      // Verify password
      const isPasswordValid = await this.passwordService.verifyPassword(
        loginRequest.password,
        user.password_hash,
      );

      if (!isPasswordValid) {
        throw new HttpErrors.Unauthorized('Invalid email or password');
      }

      // Update last login timestamp
      await this.usersRepository.updateById(user.id, {
        last_login: new Date().toISOString(),
      });

      // Fetch account details
      const account = await this.accountsRepository.findById(user.account_id);

      // Generate JWT token
      const authUser: AuthUser = {
        id: user.id,
        email: user.email,
        name: user.name,
        role: user.role,
        account_id: user.account_id,
        status: user.status,
        account: {
          id: account.id,
          name: account.name,
          domain: account.domain,
          status: account.status,
        },
      };

      const token = await this.jwtService.generateToken(authUser);
      const expiresIn = this.jwtService.getTokenExpiration();

      // Return success response
      return {
        success: true,
        message: 'Login successful',
        data: {
          user: {
            id: user.id,
            name: user.name,
            email: user.email,
            role: user.role,
            account_id: user.account_id,
            status: user.status,
            last_login: new Date().toISOString(),
          },
          account: {
            id: account.id,
            name: account.name,
            domain: account.domain,
            status: account.status,
            created_at: account.created_at,
            updated_at: account.updated_at,
          },
          token,
          expires_in: expiresIn,
        },
      };
    } catch (error) {
      if (error instanceof HttpErrors.HttpError) {
        throw error;
      }

      // Log error for debugging
      console.error('Login error:', error);

      throw new HttpErrors.InternalServerError('Login failed');
    }
  }

  /**
   * User logout endpoint (optional - for token blacklisting)
   * POST /auth/logout
   */
  @post('/auth/logout')
  @response(200, {
    description: 'Logout successful',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
          },
        },
      },
    },
  })
  async logout(): Promise<{success: boolean; message: string}> {
    // In a production environment, you might want to blacklist the token
    // For now, we'll just return a success message
    return {
      success: true,
      message: 'Logout successful',
    };
  }

  /**
   * Refresh token endpoint
   * POST /auth/refresh
   */
  @post('/auth/refresh')
  @response(200, {
    description: 'Token refresh successful',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            data: {
              type: 'object',
              properties: {
                token: {type: 'string'},
                expires_in: {type: 'number'},
              },
            },
          },
        },
      },
    },
  })
  async refreshToken(): Promise<{
    success: boolean;
    message: string;
    data: {token: string; expires_in: number};
  }> {
    try {
      // Get the current user from the request (set by auth middleware)
      const currentUser = (this.request as any).user;

      if (!currentUser) {
        throw new HttpErrors.Unauthorized('No valid token found');
      }

      // Generate new token
      const token = await this.jwtService.generateToken(currentUser);
      const expiresIn = this.jwtService.getTokenExpiration();

      return {
        success: true,
        message: 'Token refreshed successfully',
        data: {
          token,
          expires_in: expiresIn,
        },
      };
    } catch (error) {
      if (error instanceof HttpErrors.HttpError) {
        throw error;
      }

      throw new HttpErrors.InternalServerError('Token refresh failed');
    }
  }
}
