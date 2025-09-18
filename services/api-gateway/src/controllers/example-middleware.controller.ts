import {param, post, get, put, del, requestBody} from '@loopback/rest';
import {HttpErrors} from '@loopback/rest';
import {Request, Response} from '@loopback/rest';
import {RestBindings} from '@loopback/rest';
import {inject, intercept} from '@loopback/core';

/**
 * Example controller demonstrating various middleware decorator usage patterns
 * This controller shows how to apply different interceptors to different endpoints
 */
export class ExampleMiddlewareController {
  constructor() {}

  /**
   * Example 1: Single middleware decorator
   * This endpoint uses only the logging interceptor
   */
  @get('/example/simple-logging', {
    responses: {
      '200': {
        description: 'Simple logging example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                timestamp: {type: 'string'},
                method: {type: 'string'},
              },
            },
          },
        },
      },
    },
  })
  @intercept('interceptor.logging')
  async simpleLogging(): Promise<any> {
    return {
      message: 'This endpoint demonstrates simple logging middleware',
      timestamp: new Date().toISOString(),
      method: 'GET',
    };
  }

  /**
   * Example 2: Multiple middleware decorators
   * This endpoint uses both CORS and rate limiting
   */
  @get('/example/cors-rate-limit', {
    responses: {
      '200': {
        description: 'CORS and rate limiting example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                headers: {type: 'object'},
              },
            },
          },
        },
      },
    },
  })
  @intercept('interceptor.cors')
  @intercept('interceptor.rateLimit')
  async corsAndRateLimit(
    @inject(RestBindings.Http.REQUEST) request: Request,
  ): Promise<any> {
    return {
      message: 'This endpoint demonstrates CORS and rate limiting middleware',
      headers: {
        origin: request.headers.origin,
        userAgent: request.headers['user-agent'],
      },
    };
  }

  /**
   * Example 3: Authentication middleware
   * This endpoint requires authentication
   */
  @get('/example/protected', {
    responses: {
      '200': {
        description: 'Protected endpoint example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                user: {type: 'object'},
              },
            },
          },
        },
      },
      '401': {
        description: 'Unauthorized - missing or invalid token',
      },
    },
  })
  @intercept('interceptor.auth')
  async protectedEndpoint(
    @inject(RestBindings.Http.REQUEST) request: Request,
  ): Promise<any> {
    const user = (request as any).user;
    return {
      message: 'This is a protected endpoint that requires authentication',
      user: {
        userId: user?.userId,
        accountId: user?.accountId,
        email: user?.email,
      },
    };
  }

  /**
   * Example 4: Full security stack
   * This endpoint uses all middleware types
   */
  @post('/example/full-security', {
    responses: {
      '200': {
        description: 'Full security example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                data: {type: 'object'},
                user: {type: 'object'},
              },
            },
          },
        },
      },
      '401': {
        description: 'Unauthorized',
      },
      '429': {
        description: 'Rate limit exceeded',
      },
    },
  })
  @intercept('interceptor.cors')
  @intercept('interceptor.auth')
  @intercept('interceptor.logging')
  @intercept('interceptor.rateLimit')
  async fullSecurity(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            properties: {
              data: {type: 'string'},
              value: {type: 'number'},
            },
          },
        },
      },
    })
    body: any,
    @inject(RestBindings.Http.REQUEST) request: Request,
  ): Promise<any> {
    const user = (request as any).user;
    return {
      message: 'This endpoint demonstrates the full security stack',
      data: body,
      user: {
        userId: user?.userId,
        accountId: user?.accountId,
      },
      timestamp: new Date().toISOString(),
    };
  }

  /**
   * Example 5: Using middleware groups
   * This endpoint uses predefined middleware groups
   */
  @get('/example/middleware-groups', {
    responses: {
      '200': {
        description: 'Middleware groups example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                groups: {type: 'array'},
              },
            },
          },
        },
      },
    },
  })
  @intercept('interceptor.cors')
  @intercept('interceptor.rateLimit')
  @intercept('interceptor.logging')
  async middlewareGroups(): Promise<any> {
    return {
      message: 'This endpoint uses middleware groups (publicApi + logging)',
      groups: ['publicApi', 'logging'],
      availableGroups: ['logging', 'auth', 'cors', 'rateLimit', 'admin', 'publicApi', 'protectedApi', 'fullSecurity', 'development', 'production'],
    };
  }

  /**
   * Example 6: Custom middleware configuration
   * This endpoint uses the advanced middleware decorator with custom config
   */
  @put('/example/custom-config/{id}', {
    responses: {
      '200': {
        description: 'Custom config example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                config: {type: 'object'},
              },
            },
          },
        },
      },
    },
  })
  @intercept('interceptor.auth')
  @intercept('interceptor.logging')
  async customConfig(
    @param.path.string('id') id: string,
    @inject(RestBindings.Http.REQUEST) request: Request,
  ): Promise<any> {
    const user = (request as any).user;
    return {
      message: 'This endpoint uses custom middleware configuration',
      config: {
        id,
        user: user?.userId,
        customSetting: 'enabled',
      },
    };
  }

  /**
   * Example 7: Role-based access control
   * This endpoint demonstrates role-based middleware (would need custom implementation)
   */
  @del('/example/admin-only/{id}', {
    responses: {
      '200': {
        description: 'Admin only example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                role: {type: 'string'},
              },
            },
          },
        },
      },
      '403': {
        description: 'Forbidden - insufficient permissions',
      },
    },
  })
  @intercept('interceptor.auth')
  @intercept('interceptor.logging')
  async adminOnly(
    @param.path.string('id') id: string,
    @inject(RestBindings.Http.REQUEST) request: Request,
  ): Promise<any> {
    const user = (request as any).user;
    
    // Custom role checking (this would typically be in a dedicated interceptor)
    if (!user?.roles?.includes('admin')) {
      throw new HttpErrors.Forbidden('Admin access required');
    }

    return {
      message: 'This endpoint is restricted to admin users only',
      role: 'admin',
      deletedId: id,
    };
  }

  /**
   * Example 8: Conditional middleware
   * This endpoint shows how to conditionally apply middleware based on environment
   */
  @get('/example/conditional', {
    responses: {
      '200': {
        description: 'Conditional middleware example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                environment: {type: 'string'},
                middleware: {type: 'array'},
              },
            },
          },
        },
      },
    },
  })
  @intercept(process.env.NODE_ENV === 'production' ? 'interceptor.cors' : 'interceptor.logging')
  async conditionalMiddleware(): Promise<any> {
    return {
      message: 'This endpoint applies different middleware based on environment',
      environment: process.env.NODE_ENV || 'development',
      middleware: process.env.NODE_ENV === 'production'
        ? ['cors', 'auth', 'rateLimit']
        : ['logging'],
    };
  }

  /**
   * Example 9: Error handling with middleware
   * This endpoint demonstrates error handling in middleware
   */
  @post('/example/error-handling', {
    responses: {
      '200': {
        description: 'Error handling example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                success: {type: 'boolean'},
              },
            },
          },
        },
      },
      '400': {
        description: 'Bad request',
      },
    },
  })
  @intercept('interceptor.logging')
  @intercept('interceptor.auth')
  async errorHandling(
    @requestBody({
      content: {
        'application/json': {
          schema: {
            type: 'object',
            properties: {
              shouldError: {type: 'boolean'},
              errorType: {type: 'string'},
            },
          },
        },
      },
    })
    body: {shouldError?: boolean; errorType?: string},
  ): Promise<any> {
    if (body.shouldError) {
      switch (body.errorType) {
        case 'badRequest':
          throw new HttpErrors.BadRequest('This is a bad request error');
        case 'unauthorized':
          throw new HttpErrors.Unauthorized('This is an unauthorized error');
        case 'forbidden':
          throw new HttpErrors.Forbidden('This is a forbidden error');
        case 'notFound':
          throw new HttpErrors.NotFound('This is a not found error');
        default:
          throw new HttpErrors.InternalServerError('This is an internal server error');
      }
    }

    return {
      message: 'No error occurred - request processed successfully',
      success: true,
    };
  }

  /**
   * Example 10: Performance monitoring with middleware
   * This endpoint demonstrates performance monitoring
   */
  @get('/example/performance', {
    responses: {
      '200': {
        description: 'Performance monitoring example',
        content: {
          'application/json': {
            schema: {
              type: 'object',
              properties: {
                message: {type: 'string'},
                duration: {type: 'number'},
                timestamp: {type: 'string'},
              },
            },
          },
        },
      },
    },
  })
  @intercept('interceptor.logging')
  async performanceMonitoring(): Promise<any> {
    const startTime = Date.now();
    
    // Simulate some processing time
    await new Promise(resolve => setTimeout(resolve, 100));
    
    const duration = Date.now() - startTime;
    
    return {
      message: 'This endpoint demonstrates performance monitoring',
      duration: `${duration}ms`,
      timestamp: new Date().toISOString(),
    };
  }
}
