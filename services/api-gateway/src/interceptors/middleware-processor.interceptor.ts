import {
  Interceptor,
  InvocationContext,
  InvocationResult,
  Provider,
  inject,
} from '@loopback/core';
import {MIDDLEWARE_METADATA_KEY} from '../decorators/middleware.decorator';

/**
 * Middleware Processor Interceptor
 * 
 * This interceptor reads @useMiddleware metadata and applies the corresponding
 * interceptors to controller methods. It's the missing piece that makes
 * the custom middleware decorator system functional.
 */
export class MiddlewareProcessorInterceptor implements Provider<Interceptor> {
  constructor(
    @inject('interceptor.auth', {optional: true})
    private authInterceptor?: Interceptor,
    @inject('interceptor.logging', {optional: true})
    private loggingInterceptor?: Interceptor,
    @inject('interceptor.rateLimit', {optional: true})
    private rateLimitInterceptor?: Interceptor,
    @inject('interceptor.cors', {optional: true})
    private corsInterceptor?: Interceptor,
  ) {}

  value(): Interceptor {
    return async (invocationCtx: InvocationContext, next: InvocationResult) => {
      // Get the target method
      const target = invocationCtx.target;
      const methodName = invocationCtx.methodName;
      
      if (!target || !methodName) {
        return next();
      }

      // Get the method from the target
      const method = (target as any)[methodName];
      if (!method) {
        return next();
      }

      // Read middleware metadata from the method
      const middlewareMeta = Reflect.getMetadata(MIDDLEWARE_METADATA_KEY, method);
      
      if (!middlewareMeta || !middlewareMeta.middlewares) {
        // No middleware configured, proceed normally
        return next();
      }

      // Get the interceptors for the middleware names
      const interceptors = this.getInterceptors(middlewareMeta.middlewares);
      
      if (interceptors.length === 0) {
        return next();
      }

      // Apply interceptors in sequence
      let currentNext = next;
      for (const interceptor of interceptors.reverse()) {
        const interceptorNext = currentNext;
        currentNext = () => interceptor(invocationCtx, interceptorNext);
      }

      return currentNext();
    };
  }

  /**
   * Get interceptors by their names
   */
  private getInterceptors(middlewareNames: string[]): Interceptor[] {
    const interceptors: Interceptor[] = [];
    
    for (const name of middlewareNames) {
      const interceptor = this.getInterceptorByName(name);
      if (interceptor) {
        interceptors.push(interceptor);
      }
    }
    
    return interceptors;
  }

  /**
   * Get interceptor by name
   */
  private getInterceptorByName(name: string): Interceptor | undefined {
    switch (name) {
      case 'interceptor.auth':
        return this.authInterceptor;
      case 'interceptor.logging':
        return this.loggingInterceptor;
      case 'interceptor.rateLimit':
        return this.rateLimitInterceptor;
      case 'interceptor.cors':
        return this.corsInterceptor;
      default:
        console.warn(`Unknown middleware: ${name}`);
        return undefined;
    }
  }

  /**
   * Apply interceptors in sequence
   */
  private async applyInterceptors(
    interceptors: Interceptor[],
    invocationCtx: InvocationContext,
    next: InvocationResult,
  ): Promise<any> {
    // Create a chain of interceptors
    let currentNext = next;
    
    // Apply interceptors in reverse order (last interceptor wraps the original next)
    for (let i = interceptors.length - 1; i >= 0; i--) {
      const interceptor = interceptors[i];
      const previousNext = currentNext;
      
      currentNext = async (ctx: InvocationContext, nextFn: InvocationResult) => {
        return interceptor(ctx, previousNext);
      };
    }
    
    // Execute the chain
    return currentNext(invocationCtx, next);
  }
}
