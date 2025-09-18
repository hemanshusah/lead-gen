import {HttpErrors} from '@loopback/rest';
import {Interceptor, InvocationContext, InvocationResult, Provider, ValueOrPromise, inject} from '@loopback/core';
import * as jwt from 'jsonwebtoken';
import {BaseMiddlewareInterceptor, MiddlewareContext, Next} from './base.interceptor';

/**
 * Configuration for authentication middleware
 */
export interface AuthConfig {
  secret?: string;
  requiredRoles?: string[];
  skipPaths?: string[];
}

/**
 * Authentication middleware interceptor
 * Validates JWT tokens and checks user/account status
 */
export class AuthInterceptor extends BaseMiddlewareInterceptor {
  private authConfig: AuthConfig;

  constructor(
    @inject('authentication.jwt.secret')
    private jwtSecret: string,
    config: AuthConfig = {}
  ) {
    super();
    this.authConfig = {
      secret: this.jwtSecret,
      requiredRoles: [],
      skipPaths: ['/auth/login', '/auth/register', '/ping', '/explorer'],
      ...config,
    };
  }

  protected async execute(context: MiddlewareContext, next: Next): Promise<any> {
    const {request} = context;
    const path = request.url;

    // Skip authentication for configured paths
    if (this.authConfig.skipPaths?.some((skipPath: string) => path.includes(skipPath))) {
      return next();
    }

    // Get authorization header
    const authHeader = request.headers['authorization'];
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      throw new HttpErrors.Unauthorized('Missing or invalid Authorization header');
    }

    const token = authHeader.replace('Bearer ', '');

    try {
      // Verify JWT token
      const decoded = jwt.verify(token, this.authConfig.secret!) as any;
      
      // Validate user and account status
      if (decoded.status !== 'active') {
        throw new HttpErrors.Unauthorized('User account is not active');
      }
      
      if (decoded.account?.status !== 'active') {
        throw new HttpErrors.Unauthorized('Account is not active');
      }
      
      // Check role-based access control
      if (this.authConfig.requiredRoles && this.authConfig.requiredRoles.length > 0) {
        const userRoles = decoded.roles || [];
        const hasRequiredRole = this.authConfig.requiredRoles.some((role: string) => 
          userRoles.includes(role)
        );
        
        if (!hasRequiredRole) {
          throw new HttpErrors.Forbidden('Insufficient permissions');
        }
      }

      // Attach user info to request
      (request as any).user = {
        id: decoded.sub,
        email: decoded.email,
        name: decoded.name,
        role: decoded.role,
        account_id: decoded.account_id,
        status: decoded.status,
        account: decoded.account,
      };
      
      return next();
    } catch (err) {
      if (err instanceof HttpErrors.HttpError) {
        throw err;
      }
      
      if (err instanceof jwt.JsonWebTokenError) {
        throw new HttpErrors.Unauthorized('Invalid JWT token');
      }
      if (err instanceof jwt.TokenExpiredError) {
        throw new HttpErrors.Unauthorized('JWT token has expired');
      }
      
      throw new HttpErrors.Unauthorized('Authentication failed');
    }
  }
}
