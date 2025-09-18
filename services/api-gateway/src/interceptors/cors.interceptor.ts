import {BaseMiddlewareInterceptor, MiddlewareContext, Next} from './base.interceptor';

/**
 * Configuration for CORS middleware
 */
export interface CorsConfig {
  /** Allowed origins */
  origin?: string | string[] | boolean | ((origin: string) => boolean);
  /** Allowed HTTP methods */
  methods?: string[];
  /** Allowed headers */
  allowedHeaders?: string[];
  /** Exposed headers */
  exposedHeaders?: string[];
  /** Credentials support */
  credentials?: boolean;
  /** Max age for preflight requests */
  maxAge?: number;
  /** Preflight continue */
  preflightContinue?: boolean;
  /** Options success status */
  optionsSuccessStatus?: number;
}

/**
 * CORS middleware interceptor
 * Handles Cross-Origin Resource Sharing headers
 */
export class CorsInterceptor extends BaseMiddlewareInterceptor {
  constructor(config: CorsConfig = {}) {
    super();
    this.config = {
      origin: true,
      methods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'],
      allowedHeaders: ['Content-Type', 'Authorization', 'X-Requested-With'],
      exposedHeaders: [],
      credentials: false,
      maxAge: 86400, // 24 hours
      preflightContinue: false,
      optionsSuccessStatus: 204,
      ...config,
    };
  }

  protected async execute(context: MiddlewareContext, next: Next): Promise<any> {
    const {request, response} = context;

    // Handle preflight requests
    if (request.method === 'OPTIONS') {
      this.handlePreflight(request, response);
      if (!this.config.preflightContinue) {
        response.statusCode = this.config.optionsSuccessStatus!;
        response.end();
        return;
      }
    }

    // Set CORS headers for actual requests
    this.setCorsHeaders(request, response);

    return next();
  }

  private handlePreflight(request: any, response: any): void {
    const origin = request.headers.origin;
    const method = request.headers['access-control-request-method'];
    const headers = request.headers['access-control-request-headers'];

    // Check origin
    if (!this.isOriginAllowed(origin)) {
      return;
    }

    // Set CORS headers
    this.setCorsHeaders(request, response);

    // Set method-specific headers
    if (method) {
      response.setHeader('Access-Control-Allow-Methods', this.config.methods!.join(', '));
    }

    if (headers) {
      response.setHeader('Access-Control-Allow-Headers', this.config.allowedHeaders!.join(', '));
    }

    if (this.config.maxAge) {
      response.setHeader('Access-Control-Max-Age', this.config.maxAge.toString());
    }
  }

  private setCorsHeaders(request: any, response: any): void {
    const origin = request.headers.origin;

    // Set Access-Control-Allow-Origin
    if (this.isOriginAllowed(origin)) {
      response.setHeader('Access-Control-Allow-Origin', origin);
    }

    // Set Access-Control-Allow-Credentials
    if (this.config.credentials) {
      response.setHeader('Access-Control-Allow-Credentials', 'true');
    }

    // Set Access-Control-Expose-Headers
    if (this.config.exposedHeaders && this.config.exposedHeaders.length > 0) {
      response.setHeader('Access-Control-Expose-Headers', this.config.exposedHeaders.join(', '));
    }
  }

  private isOriginAllowed(origin: string): boolean {
    if (!origin) return false;

    const {origin: allowedOrigin} = this.config;

    if (allowedOrigin === true) return true;
    if (allowedOrigin === false) return false;

    if (typeof allowedOrigin === 'string') {
      return allowedOrigin === origin;
    }

    if (Array.isArray(allowedOrigin)) {
      return allowedOrigin.includes(origin);
    }

    if (typeof allowedOrigin === 'function') {
      return allowedOrigin(origin);
    }

    return false;
  }
}
