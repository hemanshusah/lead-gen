import {BootMixin} from '@loopback/boot';
import {ApplicationConfig} from '@loopback/core';
import {
  RestExplorerBindings,
  RestExplorerComponent,
} from '@loopback/rest-explorer';
import {RepositoryMixin} from '@loopback/repository';
import {RestApplication} from '@loopback/rest';
import {ServiceMixin} from '@loopback/service-proxy';
import path from 'path';
import {MySequence} from './sequence';
import {
  AuthInterceptor,
  LoggingInterceptor,
  RateLimitInterceptor,
  CorsInterceptor,
} from './interceptors';
import {PasswordService, JwtService} from './services';

export {ApplicationConfig};

export class ApiGatewayApplication extends BootMixin(
  ServiceMixin(RepositoryMixin(RestApplication)),
) {
  constructor(options: ApplicationConfig = {}) {
    super(options);

    // Configure global API versioning
    this.basePath('/api/v1');

    // Set up the custom sequence
    this.sequence(MySequence);

    // Set up default home page
    this.static('/', path.join(__dirname, '../public'));

    // Customize @loopback/rest-explorer configuration here
    this.configure(RestExplorerBindings.COMPONENT).to({
      path: '/explorer',
    });
    this.component(RestExplorerComponent);

    // Register middleware interceptors
    this.registerInterceptors();

    // Register services
    this.registerServices();

    this.projectRoot = __dirname;
    // Customize @loopback/boot Booter Conventions here
    this.bootOptions = {
      controllers: {
        // Customize ControllerBooter Conventions here
        dirs: ['controllers'],
        extensions: ['.controller.js'],
        nested: true,
      },
    };
  }

  /**
   * Register all middleware interceptors
   */
  private registerInterceptors(): void {
    // Register authentication interceptor with JWT service injection
    this.interceptor(AuthInterceptor, {
      key: 'interceptor.auth',
    });

    // Register logging interceptor
    this.interceptor(LoggingInterceptor, {
      key: 'interceptor.logging',
    });

    // Register rate limiting interceptor
    this.interceptor(RateLimitInterceptor, {
      key: 'interceptor.rateLimit',
    });

    // Register CORS interceptor
    this.interceptor(CorsInterceptor, {
      key: 'interceptor.cors',
    });


    // Bind JWT secret for authentication
    this.bind('authentication.jwt.secret').to(
      process.env.JWT_SECRET || 'your-secret-key-change-in-production'
    );
  }

  /**
   * Register all services
   */
  private registerServices(): void {
    // Register password service
    this.service(PasswordService);

    // Register JWT service
    this.service(JwtService);
  }
}
