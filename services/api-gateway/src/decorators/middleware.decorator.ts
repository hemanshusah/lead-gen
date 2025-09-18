import {MethodDecoratorFactory} from '@loopback/metadata';

/**
 * Metadata key for storing middleware configuration
 */
export const MIDDLEWARE_METADATA_KEY = 'custom.middleware';

/**
 * Interface defining middleware metadata structure
 */
export interface MiddlewareMeta {
  /** Array of middleware names to apply */
  middlewares: string[];
  /** Optional configuration for specific middleware */
  config?: Record<string, any>;
  /** Execution order (lower numbers execute first) */
  order?: number;
}

/**
 * Decorator factory for applying middleware to controller methods
 * 
 * @param meta - Middleware metadata configuration
 * @returns Method decorator
 * 
 * @example
 * ```typescript
 * @middleware({middlewares: ['auth', 'logging']})
 * @get('/protected')
 * async protectedEndpoint() { ... }
 * 
 * @middleware({middlewares: ['rateLimit'], config: {requests: 100, window: '1h'}})
 * @post('/api/data')
 * async createData() { ... }
 * ```
 */
export function middleware(meta: MiddlewareMeta): MethodDecorator {
  return MethodDecoratorFactory.createDecorator<MiddlewareMeta>(
    MIDDLEWARE_METADATA_KEY,
    meta,
  );
}

/**
 * Shorthand decorator for single middleware
 * 
 * @param middlewareName - Name of the middleware to apply
 * @param config - Optional configuration
 * @returns Method decorator
 * 
 * @example
 * ```typescript
 * @useMiddleware('auth')
 * @get('/profile')
 * async getProfile() { ... }
 * ```
 */
export function useMiddleware(
  middlewareName: string, 
  config?: Record<string, any>
): MethodDecorator {
  return middleware({
    middlewares: [middlewareName],
    config,
  });
}

/**
 * Decorator for applying multiple middleware with specific order
 * 
 * @param middlewareNames - Array of middleware names
 * @param config - Optional configuration
 * @returns Method decorator
 * 
 * @example
 * ```typescript
 * @useMiddlewares(['auth', 'logging', 'rateLimit'])
 * @post('/api/secure')
 * async secureEndpoint() { ... }
 * ```
 */
export function useMiddlewares(
  middlewareNames: string[],
  config?: Record<string, any>
): MethodDecorator {
  return middleware({
    middlewares: middlewareNames,
    config,
  });
}
