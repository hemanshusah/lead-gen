# API Gateway Service

A robust LoopBack 4 API Gateway service with JWT authentication, middleware support, and lead source management.

## 🚀 Features

- **JWT Authentication**: Secure token-based authentication with user and account context
- **Middleware System**: Custom middleware decorators for authentication, logging, rate limiting, and CORS
- **Lead Source Management**: Protected APIs for fetching lead sources with their parameters
- **Database Integration**: PostgreSQL with comprehensive data models
- **Type Safety**: Full TypeScript support with proper type definitions

## 📁 Project Structure

```
src/
├── controllers/          # API Controllers
│   ├── auth.controller.ts           # Authentication endpoints
│   ├── leadsource.controller.ts     # Lead source management
│   ├── protected.controller.ts       # Protected resource examples
│   └── ping.controller.ts           # Health check
├── interceptors/         # Middleware System
│   ├── auth.interceptor.ts          # JWT authentication
│   ├── logging.interceptor.ts       # Request/response logging
│   ├── rate-limit.interceptor.ts    # Rate limiting
│   └── cors.interceptor.ts          # CORS handling
├── services/             # Business Logic
│   ├── jwt.service.ts               # JWT token management
│   └── password.service.ts          # Password hashing
├── types/                # TypeScript Definitions
│   ├── auth.types.ts                # Authentication types
│   └── leadsource.types.ts         # Lead source types
├── models/               # Database Models
├── repositories/         # Data Access Layer
└── datasources/          # Database Configuration
```

## 🛠️ Setup

### Prerequisites
- Node.js 18+
- PostgreSQL 12+
- Yarn or npm

### Installation
```bash
# Install dependencies
yarn install

# Set up environment variables
cp .env.example .env
# Edit .env with your database credentials

# Run database migrations
yarn migrate

# Start development server
yarn start:dev
```

### Environment Variables
```env
NODE_ENV=development
PORT=3011
JWT_SECRET=your-secret-key-change-in-production
DB_HOST=localhost
DB_PORT=5432
DB_USER=your-username
DB_PASSWORD=your-password
DB_NAME=leadgen
```

## 🔐 Authentication

### Login
```bash
curl -X POST http://localhost:3011/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@techcorp.com","password":"password"}'
```

### Using Protected Endpoints
```bash
# Get token
TOKEN=$(curl -s -X POST http://localhost:3011/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@techcorp.com","password":"password"}' \
  | jq -r '.data.token')

# Use token for protected endpoints
curl -X GET http://localhost:3011/api/v1/lead-sources \
  -H "Authorization: Bearer $TOKEN"
```

## 📚 API Endpoints

### Public Endpoints
- `GET /api/v1/ping` - Health check
- `POST /api/v1/auth/login` - User authentication

### Protected Endpoints
- `GET /api/v1/lead-sources` - Get available lead sources
- `GET /api/v1/lead-sources/with-saved-inputs` - Get lead sources with saved inputs
- `GET /api/v1/protected/user-info` - Get authenticated user info

## 🎯 Middleware System

### Available Middleware
- `@useMiddleware('interceptor.auth')` - JWT authentication
- `@useMiddleware('interceptor.logging')` - Request logging
- `@useMiddleware('interceptor.rateLimit')` - Rate limiting
- `@useMiddleware('interceptor.cors')` - CORS handling

### Usage Examples
```typescript
// Single middleware
@get('/protected')
@useMiddleware('interceptor.auth')
async protectedEndpoint() {
  return { message: 'This requires authentication' };
}

// Multiple middleware
@post('/secure')
@useMiddlewares(['interceptor.auth', 'interceptor.logging', 'interceptor.rateLimit'])
async secureEndpoint() {
  return { message: 'Multiple middleware applied' };
}
```

## 🗄️ Database Schema

### Key Tables
- `users` - User accounts and authentication
- `accounts` - Organization accounts
- `lead_sources` - Available data sources (Google Maps, LinkedIn, etc.)
- `account_lead_sources` - Account-specific source configurations
- `saved_inputs` - User-saved search parameters

## 🧪 Testing

### Manual Testing
```bash
# Test authentication flow
curl -X POST http://localhost:3011/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@techcorp.com","password":"password"}'

# Test protected endpoint
TOKEN="your-jwt-token-here"
curl -X GET http://localhost:3011/api/v1/lead-sources \
  -H "Authorization: Bearer $TOKEN"
```

### Automated Testing
```bash
# Run tests
yarn test

# Run with coverage
yarn test:coverage
```

## 🚀 Deployment

### Production Build
```bash
# Build for production
yarn build

# Start production server
yarn start
```

### Docker Support
```bash
# Build Docker image
docker build -t api-gateway .

# Run container
docker run -p 3011:3011 api-gateway
```

## 📝 Development

### Code Style
- TypeScript with strict mode
- ESLint configuration
- Prettier formatting
- JSDoc documentation

### Adding New Features
1. Create types in `src/types/`
2. Add models in `src/models/`
3. Implement repositories in `src/repositories/`
4. Create controllers in `src/controllers/`
5. Add middleware in `src/interceptors/`

## 🔧 Troubleshooting

### Common Issues
1. **Database Connection**: Check PostgreSQL is running and credentials are correct
2. **JWT Errors**: Ensure JWT_SECRET is consistent across services
3. **Middleware Not Working**: Verify interceptors are registered in `application.ts`

### Debug Mode
```bash
# Enable debug logging
DEBUG=loopback:* yarn start:dev
```

## 📄 License

MIT License - see LICENSE file for details.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests
5. Submit a pull request

---

**Built with ❤️ using LoopBack 4**