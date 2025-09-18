/**
 * Predefined middleware groups for common use cases
 * These groups can be applied to endpoints using the @intercept decorator
 */
export const MIDDLEWARE_GROUPS = {
  /**
   * Basic logging group - logs all requests
   */
  logging: ['interceptor.logging'],

  /**
   * Authentication group - requires valid JWT token
   */
  auth: ['interceptor.auth'],

  /**
   * CORS group - handles cross-origin requests
   */
  cors: ['interceptor.cors'],

  /**
   * Rate limiting group - basic rate limiting (100 requests per hour)
   */
  rateLimit: ['interceptor.rateLimit'],

  /**
   * Admin group - requires admin role
   */
  admin: ['interceptor.auth'],

  /**
   * Public API group - CORS + rate limiting for public endpoints
   */
  publicApi: ['interceptor.cors', 'interceptor.rateLimit'],

  /**
   * Protected API group - auth + logging for protected endpoints
   */
  protectedApi: ['interceptor.auth', 'interceptor.logging'],

  /**
   * Full security group - auth + logging + rate limiting
   */
  fullSecurity: ['interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'],

  /**
   * Development group - logging only (for development)
   */
  development: ['interceptor.logging'],

  /**
   * Production group - full security for production endpoints
   */
  production: ['interceptor.cors', 'interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'],
} as const;

/**
 * Type for middleware group names
 */
export type MiddlewareGroupName = keyof typeof MIDDLEWARE_GROUPS;

/**
 * Combine multiple middleware groups
 * 
 * @param groups - Array of middleware group names
 * @returns Combined array of middleware names (deduplicated)
 * 
 * @example
 * ```typescript
 * const combined = combineMiddlewareGroups(['auth', 'logging', 'rateLimit']);
 * ```
 */
export function combineMiddlewareGroups(groups: MiddlewareGroupName[]): string[] {
  const allMiddlewares = groups.flatMap(group => MIDDLEWARE_GROUPS[group]);
  return [...new Set(allMiddlewares)]; // Remove duplicates
}
