import {inject, intercept} from '@loopback/core';
import {
  get,
  response,
  RestBindings,
  Request,
} from '@loopback/rest';

/**
 * Protected Controller
 * Demonstrates authentication middleware functionality
 */
export class ProtectedController {
  constructor(
    @inject(RestBindings.Http.REQUEST) private request: Request,
  ) {}

  /**
   * Protected endpoint that requires authentication
   * GET /protected/user-info
   */
  @get('/protected/user-info')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'User information from authenticated request',
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
                  },
                },
                account: {
                  type: 'object',
                  properties: {
                    id: {type: 'number'},
                    name: {type: 'string'},
                    domain: {type: 'string'},
                    status: {type: 'string'},
                  },
                },
                token_info: {
                  type: 'object',
                  properties: {
                    issued_at: {type: 'string'},
                    expires_at: {type: 'string'},
                    issuer: {type: 'string'},
                    audience: {type: 'string'},
                  },
                },
              },
            },
          },
        },
      },
    },
  })
  async getUserInfo(): Promise<{
    success: boolean;
    message: string;
    data: {
      user: any;
      account: any;
      token_info: any;
    };
  }> {
    // Get user information from the request (set by auth middleware)
    const user = (this.request as any).user;

    if (!user) {
      return {
        success: false,
        message: 'Authentication required. Please provide a valid JWT token.',
        data: {
          user: null,
          account: null,
          token_info: {
            message: 'No authentication token provided or invalid token',
          },
        },
      };
    }

    return {
      success: true,
      message: 'User information retrieved successfully',
      data: {
        user: {
          id: user.id,
          name: user.name,
          email: user.email,
          role: user.role,
          account_id: user.account_id,
          status: user.status,
        },
        account: user.account,
        token_info: {
          // This would be extracted from the JWT token if needed
          message: 'Token verified and user authenticated',
        },
      },
    };
  }

  /**
   * Admin-only endpoint
   * GET /protected/admin-only
   */
  @get('/protected/admin-only')
  @intercept('interceptor.auth')
  @response(200, {
    description: 'Admin-only endpoint',
    content: {
      'application/json': {
        schema: {
          type: 'object',
          properties: {
            success: {type: 'boolean'},
            message: {type: 'string'},
            data: {type: 'object'},
          },
        },
      },
    },
  })
  async getAdminInfo(): Promise<{
    success: boolean;
    message: string;
    data: any;
  }> {
    const user = (this.request as any).user;

    if (!user) {
      return {
        success: false,
        message: 'Authentication required. Please provide a valid JWT token.',
        data: {
          admin_user: null,
          admin_role: null,
          account: null,
          access_level: 'none',
        },
      };
    }

    return {
      success: true,
      message: 'Admin access granted',
      data: {
        admin_user: user.name,
        admin_role: user.role,
        account: user.account.name,
        access_level: 'admin',
      },
    };
  }
}
