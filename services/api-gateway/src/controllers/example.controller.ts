import {inject, intercept} from '@loopback/core';
import {
  get,
  post,
  put,
  del,
  requestBody,
  response,
  RestBindings,
  Request,
  HttpErrors,
} from '@loopback/rest';
import {useMiddleware, useMiddlewares, middleware} from '../decorators/middleware.decorator';

/**
 * Example Controller
 * Demonstrates various middleware usage patterns and authentication scenarios
 */
export class ExampleController {
  constructor(
    @inject(RestBindings.Http.REQUEST) private request: Request,
  ) {}

  /**
   * PUBLIC ENDPOINT - No authentication required
   * GET /example/public
   */
  @get('/example/public')
  @response(200, {
    description: 'Public endpoint accessible without authentication',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            message: {type: 'string'},
            timestamp: {type: 'string'},
            public: {type: 'boolean'},
          },
        },
      },
    },
  })
  async getPublicData(): Promise<{
    message: string;
    timestamp: string;
    public: boolean;
  }> {
    return {
      message: 'This is a public endpoint - no authentication required',
      timestamp: new Date().toISOString(),
      public: true,
    };
  }

  /**
   * PROTECTED ENDPOINT - Requires authentication
   * GET /example/protected
   */
  @get('/example/protected')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Protected endpoint requiring authentication',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            message: {type: 'string'},
            user: {type: 'object'},
            account: {type: 'object'},
            timestamp: {type: 'string'},
          },
        },
      },
    },
  })
  async getProtectedData(): Promise<{
    message: string;
    user: any;
    account: any;
    timestamp: string;
  }> {
    // Get user information from the request (set by auth middleware)
    const user = (this.request as any).user;

    if (!user) {
      return {
        message: 'Authentication required. Please provide a valid JWT token.',
        user: null,
        account: null,
        timestamp: new Date().toISOString(),
      };
    }

    return {
      message: 'Welcome to the protected area!',
      user: {
        id: user.id,
        name: user.name,
        email: user.email,
        role: user.role,
      },
      account: user.account,
      timestamp: new Date().toISOString(),
    };
  }

  /**
   * ADMIN ENDPOINT - Requires admin role
   * GET /example/admin
   */
  @get('/example/admin')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Admin-only endpoint',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            message: {type: 'string'},
            admin_user: {type: 'string'},
            admin_role: {type: 'string'},
            permissions: {type: 'array', items: {type: 'string'}},
          },
        },
      },
    },
  })
  async getAdminData(): Promise<{
    message: string;
    admin_user: string;
    admin_role: string;
    permissions: string[];
  }> {
    const user = (this.request as any).user;

    if (!user) {
      throw new HttpErrors.Unauthorized('Authentication required');
    }

    // Check if user has admin role
    if (user.role !== 'admin') {
      throw new HttpErrors.Forbidden('Admin access required');
    }

    return {
      message: 'Admin dashboard data',
      admin_user: user.name,
      admin_role: user.role,
      permissions: ['read', 'write', 'delete', 'admin'],
    };
  }

  /**
   * MULTIPLE MIDDLEWARE ENDPOINT - Auth + Logging + Rate Limiting
   * POST /example/secure
   */
  @post('/example/secure')
  @intercept('interceptor.auth')
  @intercept('interceptor.logging')
  @intercept('interceptor.rateLimit')
  @response(200, {
    description: 'Secure endpoint with multiple middleware layers',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            message: {type: 'string'},
            user: {type: 'object'},
            data: {type: 'object'},
            security_level: {type: 'string'},
          },
        },
      },
    },
  })
  async createSecureData(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            properties: {
              title: {type: 'string'},
              content: {type: 'string'},
              sensitive: {type: 'boolean'},
            },
            required: ['title', 'content'],
          },
        },
      },
    })
    data: {
      title: string;
      content: string;
      sensitive?: boolean;
    },
  ): Promise<{
    message: string;
    user: any;
    data: any;
    security_level: string;
  }> {
    const user = (this.request as any).user;

    if (!user) {
      throw new HttpErrors.Unauthorized('Authentication required');
    }

    return {
      message: 'Secure data created successfully',
      user: {
        id: user.id,
        name: user.name,
        role: user.role,
      },
      data: {
        ...data,
        created_by: user.id,
        created_at: new Date().toISOString(),
      },
      security_level: 'high',
    };
  }

  /**
   * USER PROFILE ENDPOINT - User-specific data
   * GET /example/profile
   */
  @get('/example/profile')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'User profile information',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            user: {type: 'object'},
            account: {type: 'object'},
            preferences: {type: 'object'},
            last_login: {type: 'string'},
          },
        },
      },
    },
  })
  async getUserProfile(): Promise<{
    user: any;
    account: any;
    preferences: any;
    last_login: string;
  }> {
    const user = (this.request as any).user;

    if (!user) {
      throw new HttpErrors.Unauthorized('Authentication required');
    }

    return {
      user: {
        id: user.id,
        name: user.name,
        email: user.email,
        role: user.role,
        status: user.status,
      },
      account: user.account,
      preferences: {
        theme: 'dark',
        notifications: true,
        language: 'en',
      },
      last_login: new Date().toISOString(),
    };
  }

  /**
   * ACCOUNT MANAGEMENT ENDPOINT - Account-specific operations
   * PUT /example/account/settings
   */
  @put('/example/account/settings')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Update account settings',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            message: {type: 'string'},
            account: {type: 'object'},
            updated_by: {type: 'string'},
            updated_at: {type: 'string'},
          },
        },
      },
    },
  })
  async updateAccountSettings(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            properties: {
              name: {type: 'string'},
              domain: {type: 'string'},
              settings: {type: 'object'},
            },
          },
        },
      },
    })
    settings: {
      name?: string;
      domain?: string;
      settings?: any;
    },
  ): Promise<{
    message: string;
    account: any;
    updated_by: string;
    updated_at: string;
  }> {
    const user = (this.request as any).user;

    if (!user) {
      throw new HttpErrors.Unauthorized('Authentication required');
    }

    // Simulate account update
    const updatedAccount = {
      ...user.account,
      ...settings,
      updated_at: new Date().toISOString(),
    };

    return {
      message: 'Account settings updated successfully',
      account: updatedAccount,
      updated_by: user.name,
      updated_at: new Date().toISOString(),
    };
  }

  /**
   * ERROR HANDLING ENDPOINT - Demonstrates error scenarios
   * GET /example/error-test
   */
  @get('/example/error-test')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Error handling demonstration',
  })
  async testErrorHandling(): Promise<any> {
    const user = (this.request as any).user;

    if (!user) {
      // This will be handled gracefully by the controller
      return {
        error: 'No user found',
        message: 'Authentication middleware did not set user information',
      };
    }

    // Simulate different error scenarios
    const errorType = this.request.query.error_type as string;

    switch (errorType) {
      case 'unauthorized':
        throw new HttpErrors.Unauthorized('Custom unauthorized error');
      case 'forbidden':
        throw new HttpErrors.Forbidden('Custom forbidden error');
      case 'not_found':
        throw new HttpErrors.NotFound('Custom not found error');
      case 'bad_request':
        throw new HttpErrors.BadRequest('Custom bad request error');
      default:
        return {
          message: 'No error - everything is working fine!',
          user: user.name,
          timestamp: new Date().toISOString(),
        };
    }
  }
}
