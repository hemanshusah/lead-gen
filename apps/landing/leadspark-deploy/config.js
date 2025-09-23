// LeadSpark Backend Configuration
module.exports = {
  // Server Configuration
  port: process.env.PORT || 3001,
  nodeEnv: process.env.NODE_ENV || 'development',

  // Database Configuration
  database: {
    host: process.env.DB_HOST || '62.72.57.136',
    user: process.env.DB_USER || 'leadgenadmin',
    password: process.env.DB_PASSWORD || '7yLrHid7s5Wa',
    database: process.env.DB_NAME || 'leadgen',
    port: process.env.DB_PORT || 5432,
    ssl: false
  },

  // JWT Configuration
  jwt: {
    secret: process.env.JWT_SECRET || 'your-super-secret-jwt-key-change-this-in-production-please-use-a-strong-random-string',
    expiresIn: '7d'
  },

  // CORS Configuration
  cors: {
    origin: process.env.CORS_ORIGIN ? process.env.CORS_ORIGIN.split(',') : [
      'http://localhost:8010',
      'http://localhost:3000',
      'https://yourdomain.com'
    ],
    credentials: true
  },

  // Rate Limiting
  rateLimit: {
    windowMs: parseInt(process.env.RATE_LIMIT_WINDOW_MS) || 15 * 60 * 1000, // 15 minutes
    max: parseInt(process.env.RATE_LIMIT_MAX_REQUESTS) || 100
  }
};
