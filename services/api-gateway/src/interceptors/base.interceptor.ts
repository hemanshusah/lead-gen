import {
  Provider,
  InvocationContext,
  Interceptor,
  inject,
} from '@loopback/core';
import {RestBindings} from '@loopback/rest';

// Re-export Next type for use in other interceptors
export type Next = () => Promise<any> | any;
import {Request, Response} from '@loopback/rest';

/**
 * Base interface for middleware configuration
 */
export interface MiddlewareConfig {
  [key: string]: any;
}

/**
 * Context object passed to middleware
 */
export interface MiddlewareContext {
  request: Request;
  response: Response;
  invocationCtx: InvocationContext;
  config?: MiddlewareConfig;
}

/**
 * Base class for all middleware interceptors
 */
export abstract class BaseMiddlewareInterceptor implements Provider<Interceptor> {
  protected config: MiddlewareConfig = {};

  constructor(
    @inject('middleware.config', {optional: true})
    config: MiddlewareConfig = {},
  ) {
    this.config = config;
  }

  /**
   * Get the interceptor implementation
   */
  value(): Interceptor {
    return async (invocationCtx: InvocationContext, next: Next) => {
      // Get the Request object from the invocation context
      let request: Request | undefined;
      let response: Response | undefined;

      // Try to get request from the context using LoopBack's standard approach
      try {
        // Check if this is an HTTP request by looking for RestBindings.Http.REQUEST
        const requestBinding = invocationCtx.getSync(RestBindings.Http.REQUEST, {optional: true});
        const responseBinding = invocationCtx.getSync(RestBindings.Http.RESPONSE, {optional: true});
        
        if (requestBinding) {
          request = requestBinding;
          response = responseBinding;
        }
      } catch (error) {
        // If we can't get request/response, just proceed
        return next();
      }

      if (!request) {
        // Not an HTTP request, just proceed
        return next();
      }

      const context: MiddlewareContext = {
        request,
        response: response || {} as Response,
        invocationCtx,
        config: this.config,
      };

      // Execute the middleware
      return this.execute(context, next);
    };
  }

  /**
   * Execute the middleware logic
   * Override this method in subclasses
   */
  protected abstract execute(
    context: MiddlewareContext,
    next: Next,
  ): Promise<any>;
}

/**
 * Interface for middleware that can be configured
 */
export interface ConfigurableMiddleware {
  configure(config: MiddlewareConfig): void;
}

/**
 * Abstract base class for configurable middleware
 */
export abstract class ConfigurableMiddlewareInterceptor 
  extends BaseMiddlewareInterceptor 
  implements ConfigurableMiddleware {
  
  configure(config: MiddlewareConfig): void {
    this.config = {...this.config, ...config};
  }
}
