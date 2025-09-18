import {HttpErrors} from '@loopback/rest';
import {BaseMiddlewareInterceptor, MiddlewareContext, Next} from './base.interceptor';

/**
 * Configuration for rate limiting middleware
 */
export interface RateLimitConfig {
  /** Maximum number of requests */
  maxRequests: number;
  /** Time window in milliseconds */
  windowMs: number;
  /** Custom key generator function */
  keyGenerator?: (request: any) => string;
  /** Skip rate limiting for certain paths */
  skipPaths?: string[];
  /** Custom error message */
  errorMessage?: string;
}

/**
 * In-memory store for rate limiting (use Redis in production)
 */
class RateLimitStore {
  private store = new Map<string, {count: number; resetTime: number}>();

  get(key: string): {count: number; resetTime: number} | undefined {
    const entry = this.store.get(key);
    if (entry && Date.now() > entry.resetTime) {
      this.store.delete(key);
      return undefined;
    }
    return entry;
  }

  set(key: string, count: number, resetTime: number): void {
    this.store.set(key, {count, resetTime});
  }

  increment(key: string, windowMs: number): {count: number; resetTime: number} {
    const now = Date.now();
    const entry = this.get(key);
    
    if (!entry) {
      const newEntry = {count: 1, resetTime: now + windowMs};
      this.set(key, newEntry.count, newEntry.resetTime);
      return newEntry;
    }

    entry.count++;
    this.set(key, entry.count, entry.resetTime);
    return entry;
  }
}

/**
 * Rate limiting middleware interceptor
 * Limits the number of requests per time window per client
 */
export class RateLimitInterceptor extends BaseMiddlewareInterceptor {
  private store: RateLimitStore;

  constructor(config: RateLimitConfig) {
    super();
    this.config = {
      keyGenerator: (request: any) => request.ip || 'unknown',
      errorMessage: 'Too many requests, please try again later',
      ...config,
    };
    this.store = new RateLimitStore();
  }

  protected async execute(context: MiddlewareContext, next: Next): Promise<any> {
    const {request} = context;
    const path = request.url;

    // Skip rate limiting for configured paths
    if (this.config.skipPaths?.some((skipPath: string) => path.includes(skipPath))) {
      return next();
    }

    // Generate rate limit key
    const key = this.config.keyGenerator!(request);
    const rateLimitKey = `rate_limit:${key}:${path}`;

    // Check current rate limit status
    const entry = this.store.increment(rateLimitKey, this.config.windowMs);

    // Check if limit exceeded
    if (entry.count > this.config.maxRequests) {
      const resetTime = new Date(entry.resetTime).toISOString();
      const error = new HttpErrors.TooManyRequests(this.config.errorMessage!);
      error.details = {
        retryAfter: Math.ceil((entry.resetTime - Date.now()) / 1000),
        resetTime,
        limit: this.config.maxRequests,
        remaining: 0,
      };
      throw error;
    }

    // Add rate limit headers to response
    const response = context.response;
    response.setHeader('X-RateLimit-Limit', this.config.maxRequests.toString());
    response.setHeader('X-RateLimit-Remaining', Math.max(0, this.config.maxRequests - entry.count).toString());
    response.setHeader('X-RateLimit-Reset', Math.ceil(entry.resetTime / 1000).toString());

    return next();
  }
}
