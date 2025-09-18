import {BaseMiddlewareInterceptor, MiddlewareContext, Next} from './base.interceptor';

/**
 * Configuration for logging middleware
 */
export interface LoggingConfig {
  /** Log level (debug, info, warn, error) */
  level?: 'debug' | 'info' | 'warn' | 'error';
  /** Include request body in logs */
  includeBody?: boolean;
  /** Include response body in logs */
  includeResponse?: boolean;
  /** Custom log format */
  format?: 'json' | 'text';
  /** Skip logging for certain paths */
  skipPaths?: string[];
}

/**
 * Logging middleware interceptor
 * Logs HTTP requests and responses with configurable detail level
 */
export class LoggingInterceptor extends BaseMiddlewareInterceptor {
  constructor(config: LoggingConfig = {}) {
    super();
    this.config = {
      level: 'info',
      includeBody: false,
      includeResponse: false,
      format: 'text',
      skipPaths: [],
      ...config,
    };
  }

  protected async execute(context: MiddlewareContext, next: Next): Promise<any> {
    const {request, response, invocationCtx} = context;
    const path = request.url;

    // Skip logging for configured paths
    if (this.config.skipPaths?.some((skipPath: string) => path.includes(skipPath))) {
      return next();
    }

    const startTime = Date.now();
    const requestId = this.generateRequestId();

    // Log request
    this.logRequest(request, requestId);

    try {
      const result = await next();
      const duration = Date.now() - startTime;

      // Log successful response
      this.logResponse(request, response, requestId, duration, result);
      
      return result;
    } catch (error) {
      const duration = Date.now() - startTime;

      // Log error response
      this.logError(request, response, requestId, duration, error);
      
      throw error;
    }
  }

  private logRequest(request: any, requestId: string): void {
    const logData: any = {
      requestId,
      timestamp: new Date().toISOString(),
      method: request.method,
      url: request.url,
      headers: this.sanitizeHeaders(request.headers),
      userAgent: request.headers['user-agent'],
      ip: request.ip || request.connection?.remoteAddress,
    };

    if (this.config.includeBody && request.body) {
      logData.body = this.sanitizeBody(request.body);
    }

    this.log('info', 'Request received', logData);
  }

  private logResponse(request: any, response: any, requestId: string, duration: number, result?: any): void {
    const logData: any = {
      requestId,
      timestamp: new Date().toISOString(),
      method: request.method,
      url: request.url,
      statusCode: response.statusCode,
      duration: `${duration}ms`,
    };

    if (this.config.includeResponse && result) {
      logData.response = this.sanitizeResponse(result);
    }

    this.log('info', 'Request completed', logData);
  }

  private logError(request: any, response: any, requestId: string, duration: number, error: any): void {
    const logData = {
      requestId,
      timestamp: new Date().toISOString(),
      method: request.method,
      url: request.url,
      statusCode: response.statusCode || 500,
      duration: `${duration}ms`,
      error: {
        name: error.name,
        message: error.message,
        stack: error.stack,
      },
    };

    this.log('error', 'Request failed', logData);
  }

  private log(level: string, message: string, data: any): void {
    if (this.config.format === 'json') {
      console.log(JSON.stringify({
        level,
        message,
        ...data,
      }));
    } else {
      console.log(`[${level.toUpperCase()}] ${message}:`, data);
    }
  }

  private generateRequestId(): string {
    return Math.random().toString(36).substring(2, 15) + 
           Math.random().toString(36).substring(2, 15);
  }

  private sanitizeHeaders(headers: any): any {
    const sanitized = {...headers};
    // Remove sensitive headers
    delete sanitized.authorization;
    delete sanitized.cookie;
    return sanitized;
  }

  private sanitizeBody(body: any): any {
    if (typeof body === 'object') {
      const sanitized = {...body};
      // Remove sensitive fields
      delete sanitized.password;
      delete sanitized.token;
      delete sanitized.secret;
      return sanitized;
    }
    return body;
  }

  private sanitizeResponse(response: any): any {
    // Implement response sanitization logic
    return response;
  }
}
