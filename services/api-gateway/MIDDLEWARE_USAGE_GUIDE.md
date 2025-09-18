# Middleware Decorator Usage Guide

This guide demonstrates how to use the custom middleware decorator system in the API Gateway project.

## Overview

The middleware system allows you to apply interceptors to controller methods using decorators. This provides a clean, declarative way to add cross-cutting concerns like authentication, logging, rate limiting, and CORS to your API endpoints.

## Available Interceptors

- **`interceptor.auth`** - JWT authentication and authorization
- **`interceptor.logging`** - Request/response logging
- **`interceptor.rateLimit`** - Rate limiting protection
- **`interceptor.cors`** - Cross-Origin Resource Sharing

## Decorator Types

### 1. Single Middleware (`@useMiddleware`)

Apply a single interceptor to an endpoint:

```typescript
@get('/example/simple')
@useMiddleware('interceptor.logging')
async simpleEndpoint() {
  return { message: 'Simple logging middleware' };
}
```

### 2. Multiple Middleware (`@useMiddlewares`)

Apply multiple interceptors to an endpoint:

```typescript
@post('/example/multiple')
@useMiddlewares(['interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'])
async multipleMiddleware() {
  return { message: 'Multiple middleware applied' };
}
```

### 3. Advanced Configuration (`@middleware`)

Apply middleware with custom configuration:

```typescript
@put('/example/advanced')
@middleware({
  middlewares: ['interceptor.auth', 'interceptor.logging'],
  config: {
    skipPaths: ['/health'],
    logLevel: 'debug',
  },
  order: 1,
})
async advancedMiddleware() {
  return { message: 'Advanced middleware configuration' };
}
```

## Middleware Groups

Predefined groups of middleware for common use cases:

```typescript
// Available groups
const MIDDLEWARE_GROUPS = {
  logging: ['interceptor.logging'],
  auth: ['interceptor.auth'],
  cors: ['interceptor.cors'],
  rateLimit: ['interceptor.rateLimit'],
  admin: ['interceptor.auth'],
  publicApi: ['interceptor.cors', 'interceptor.rateLimit'],
  protectedApi: ['interceptor.auth', 'interceptor.logging'],
  fullSecurity: ['interceptor.cors', 'interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'],
  development: ['interceptor.logging'],
  production: ['interceptor.cors', 'interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'],
};
```

### Using Middleware Groups

```typescript
import { combineMiddlewareGroups } from '../interceptors/middleware-groups';

@get('/example/groups')
@useMiddlewares(combineMiddlewareGroups(['publicApi', 'logging']))
async middlewareGroups() {
  return { message: 'Using middleware groups' };
}
```

## Example Endpoints

The `ExampleMiddlewareController` provides comprehensive examples of different middleware usage patterns:

### 1. Simple Logging
```bash
GET /api/v1/example/simple-logging
```
- Uses only logging middleware
- No authentication required

### 2. CORS and Rate Limiting
```bash
GET /api/v1/example/cors-rate-limit
```
- Uses CORS and rate limiting middleware
- No authentication required

### 3. Protected Endpoint
```bash
GET /api/v1/example/protected
Authorization: Bearer <your-jwt-token>
```
- Requires authentication
- Returns user information

### 4. Full Security Stack
```bash
POST /api/v1/example/full-security
Authorization: Bearer <your-jwt-token>
Content-Type: application/json

{
  "data": "test data",
  "value": 123
}
```
- Uses all middleware types: CORS, Auth, Logging, Rate Limiting

### 5. Middleware Groups
```bash
GET /api/v1/example/middleware-groups
```
- Demonstrates using predefined middleware groups

### 6. Custom Configuration
```bash
PUT /api/v1/example/custom-config/123
Authorization: Bearer <your-jwt-token>
```
- Uses advanced middleware configuration

### 7. Admin Only
```bash
DELETE /api/v1/example/admin-only/123
Authorization: Bearer <your-jwt-token>
```
- Requires admin role (custom role checking)

### 8. Conditional Middleware
```bash
GET /api/v1/example/conditional
```
- Applies different middleware based on environment

### 9. Error Handling
```bash
POST /api/v1/example/error-handling
Authorization: Bearer <your-jwt-token>
Content-Type: application/json

{
  "shouldError": true,
  "errorType": "badRequest"
}
```
- Demonstrates error handling with middleware

### 10. Performance Monitoring
```bash
GET /api/v1/example/performance
```
- Shows performance monitoring capabilities

## Testing the Examples

### 1. Get Authentication Token

First, get a JWT token by logging in:

```bash
curl -X POST http://127.0.0.1:3011/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password123"
  }'
```

### 2. Test Simple Endpoints (No Auth Required)

```bash
# Simple logging
curl http://127.0.0.1:3011/api/v1/example/simple-logging

# CORS and rate limiting
curl http://127.0.0.1:3011/api/v1/example/cors-rate-limit

# Middleware groups
curl http://127.0.0.1:3011/api/v1/example/middleware-groups

# Conditional middleware
curl http://127.0.0.1:3011/api/v1/example/conditional

# Performance monitoring
curl http://127.0.0.1:3011/api/v1/example/performance
```

### 3. Test Protected Endpoints (Auth Required)

Replace `<TOKEN>` with your actual JWT token:

```bash
# Protected endpoint
curl -H "Authorization: Bearer <TOKEN>" \
  http://127.0.0.1:3011/api/v1/example/protected

# Full security stack
curl -X POST http://127.0.0.1:3011/api/v1/example/full-security \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{"data": "test", "value": 123}'

# Custom configuration
curl -X PUT http://127.0.0.1:3011/api/v1/example/custom-config/123 \
  -H "Authorization: Bearer <TOKEN>"

# Admin only (will fail if user is not admin)
curl -X DELETE http://127.0.0.1:3011/api/v1/example/admin-only/123 \
  -H "Authorization: Bearer <TOKEN>"

# Error handling
curl -X POST http://127.0.0.1:3011/api/v1/example/error-handling \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{"shouldError": true, "errorType": "badRequest"}'
```

## Best Practices

### 1. Order of Middleware
Apply middleware in logical order:
1. CORS (first - handles preflight requests)
2. Authentication (early - validates user)
3. Rate limiting (after auth - per user limits)
4. Logging (last - captures everything)

### 2. Environment-Specific Middleware
```typescript
@useMiddlewares(
  process.env.NODE_ENV === 'production'
    ? ['interceptor.cors', 'interceptor.auth', 'interceptor.rateLimit']
    : ['interceptor.logging']
)
```

### 3. Conditional Application
```typescript
@useMiddleware('interceptor.auth')
async protectedEndpoint() {
  // Only authenticated users can access
}

// vs

async publicEndpoint() {
  // No middleware - public access
}
```

### 4. Error Handling
Always handle errors appropriately in your middleware:

```typescript
@useMiddlewares(['interceptor.auth', 'interceptor.logging'])
async endpointWithErrorHandling() {
  try {
    // Your logic here
  } catch (error) {
    // Error will be caught by logging interceptor
    throw new HttpErrors.InternalServerError('Something went wrong');
  }
}
```

## Creating Custom Interceptors

To create a custom interceptor:

1. Extend `BaseMiddlewareInterceptor`
2. Implement the `execute` method
3. Register it in `application.ts`
4. Use it with decorators

Example:

```typescript
export class CustomInterceptor extends BaseMiddlewareInterceptor {
  protected async execute(context: MiddlewareContext, next: Next): Promise<any> {
    // Your custom logic here
    console.log('Custom interceptor executed');
    return next();
  }
}
```

Register in `application.ts`:

```typescript
this.interceptor(CustomInterceptor, {key: 'interceptor.custom'});
```

Use with decorator:

```typescript
@useMiddleware('interceptor.custom')
async myEndpoint() {
  return { message: 'Custom interceptor applied' };
}
```

## Troubleshooting

### Common Issues

1. **Middleware not applied**: Ensure the interceptor is registered in `application.ts`
2. **Authentication errors**: Check JWT token format and expiration
3. **Rate limiting**: Verify rate limit configuration
4. **CORS issues**: Ensure CORS interceptor is applied first

### Debug Mode

Enable debug logging by setting environment variable:

```bash
DEBUG=* yarn start:dev
```

This will show detailed middleware execution logs.

## Conclusion

The middleware decorator system provides a powerful, flexible way to add cross-cutting concerns to your API endpoints. Use the examples in `ExampleMiddlewareController` as a reference for implementing your own middleware patterns.
