const express = require('express');
const { Pool } = require('pg');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const cors = require('cors');
const helmet = require('helmet');
const rateLimit = require('express-rate-limit');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3001;

// Database configuration
const pool = new Pool({
  host: '62.72.57.136',
  user: 'leadgenadmin',
  password: '7yLrHid7s5Wa',
  database: 'leadgen',
  port: 5432,
  ssl: false // Set to true if your database requires SSL
});

// Middleware
app.use(helmet());
app.use(cors({
  origin: ['http://localhost:8010', 'http://localhost:3000', 'https://yourdomain.com'],
  credentials: true
}));
app.use(express.json());

// Rate limiting
const limiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100 // limit each IP to 100 requests per windowMs
});
app.use('/api/', limiter);

// JWT secret (in production, use environment variable)
const JWT_SECRET = process.env.JWT_SECRET || 'your-super-secret-jwt-key-change-this-in-production';

// Middleware to verify JWT token
const authenticateToken = (req, res, next) => {
  const authHeader = req.headers['authorization'];
  const token = authHeader && authHeader.split(' ')[1];

  if (!token) {
    return res.status(401).json({ error: 'Access token required' });
  }

  jwt.verify(token, JWT_SECRET, (err, user) => {
    if (err) {
      return res.status(403).json({ error: 'Invalid or expired token' });
    }
    req.user = user;
    next();
  });
};

// Test database connection
pool.on('connect', () => {
  console.log('✅ Connected to PostgreSQL database');
});

pool.on('error', (err) => {
  console.error('❌ Database connection error:', err);
});

// Routes

// Health check
app.get('/api/health', (req, res) => {
  res.json({ status: 'OK', timestamp: new Date().toISOString() });
});

// Waitlist endpoints
app.post('/api/waitlist', async (req, res) => {
  try {
    const { email, name, phone, source = 'landing_page', metadata = {} } = req.body;

    // Validation
    if (!email || !name || !phone) {
      return res.status(400).json({ error: 'Email, name, and phone are required' });
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      return res.status(400).json({ error: 'Invalid email format' });
    }

    // Phone validation
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
    if (!phoneRegex.test(phone)) {
      return res.status(400).json({ error: 'Invalid phone format' });
    }

    const result = await pool.query(
      `INSERT INTO waitlist (email, name, phone, source, metadata) 
       VALUES ($1, $2, $3, $4, $5) 
       RETURNING *`,
      [email.toLowerCase().trim(), name.trim(), phone.trim(), source, JSON.stringify(metadata)]
    );

    res.status(201).json({
      success: true,
      data: result.rows[0],
      message: 'Successfully added to waitlist'
    });

  } catch (error) {
    if (error.code === '23505') { // Unique constraint violation
      res.status(409).json({ error: 'Email already exists in waitlist' });
    } else {
      console.error('Waitlist error:', error);
      res.status(500).json({ error: 'Internal server error' });
    }
  }
});

// Get waitlist stats
app.get('/api/waitlist/stats', async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM waitlist_stats');
    res.json({ success: true, data: result.rows[0] });
  } catch (error) {
    console.error('Stats error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// User registration
app.post('/api/auth/register', async (req, res) => {
  try {
    const { email, name, phone, password } = req.body;

    // Validation
    if (!email || !name || !password) {
      return res.status(400).json({ error: 'Email, name, and password are required' });
    }

    if (password.length < 8) {
      return res.status(400).json({ error: 'Password must be at least 8 characters' });
    }

    // Check if user already exists
    const existingUser = await pool.query('SELECT id FROM users WHERE email = $1', [email.toLowerCase()]);
    if (existingUser.rows.length > 0) {
      return res.status(409).json({ error: 'User already exists' });
    }

    // Hash password
    const saltRounds = 12;
    const passwordHash = await bcrypt.hash(password, saltRounds);

    // Create user
    const result = await pool.query(
      `INSERT INTO users (email, name, phone, password_hash) 
       VALUES ($1, $2, $3, $4) 
       RETURNING id, email, name, phone, created_at`,
      [email.toLowerCase().trim(), name.trim(), phone?.trim() || null, passwordHash]
    );

    const user = result.rows[0];

    // Generate JWT token
    const token = jwt.sign(
      { userId: user.id, email: user.email },
      JWT_SECRET,
      { expiresIn: '7d' }
    );

    res.status(201).json({
      success: true,
      data: {
        user: {
          id: user.id,
          email: user.email,
          name: user.name,
          phone: user.phone,
          created_at: user.created_at
        },
        token
      },
      message: 'User created successfully'
    });

  } catch (error) {
    console.error('Registration error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// User login
app.post('/api/auth/login', async (req, res) => {
  try {
    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({ error: 'Email and password are required' });
    }

    // Get user
    const result = await pool.query(
      'SELECT id, email, name, phone, password_hash FROM users WHERE email = $1',
      [email.toLowerCase()]
    );

    if (result.rows.length === 0) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    const user = result.rows[0];

    // Verify password
    const isValidPassword = await bcrypt.compare(password, user.password_hash);
    if (!isValidPassword) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    // Update last login
    await pool.query(
      'UPDATE users SET last_login = NOW() WHERE id = $1',
      [user.id]
    );

    // Generate JWT token
    const token = jwt.sign(
      { userId: user.id, email: user.email },
      JWT_SECRET,
      { expiresIn: '7d' }
    );

    res.json({
      success: true,
      data: {
        user: {
          id: user.id,
          email: user.email,
          name: user.name,
          phone: user.phone
        },
        token
      },
      message: 'Login successful'
    });

  } catch (error) {
    console.error('Login error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Get user profile
app.get('/api/auth/profile', authenticateToken, async (req, res) => {
  try {
    const result = await pool.query(
      'SELECT id, email, name, phone, created_at, last_login FROM users WHERE id = $1',
      [req.user.userId]
    );

    if (result.rows.length === 0) {
      return res.status(404).json({ error: 'User not found' });
    }

    res.json({
      success: true,
      data: result.rows[0]
    });

  } catch (error) {
    console.error('Profile error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Leads endpoints (protected)
app.get('/api/leads', authenticateToken, async (req, res) => {
  try {
    const result = await pool.query(
      'SELECT * FROM leads WHERE user_id = $1 ORDER BY created_at DESC',
      [req.user.userId]
    );

    res.json({
      success: true,
      data: result.rows
    });

  } catch (error) {
    console.error('Leads error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

app.post('/api/leads', authenticateToken, async (req, res) => {
  try {
    const { name, email, phone, company, status = 'new', source, notes, metadata = {} } = req.body;

    if (!name) {
      return res.status(400).json({ error: 'Name is required' });
    }

    const result = await pool.query(
      `INSERT INTO leads (user_id, name, email, phone, company, status, source, notes, metadata) 
       VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9) 
       RETURNING *`,
      [req.user.userId, name, email, phone, company, status, source, notes, JSON.stringify(metadata)]
    );

    res.status(201).json({
      success: true,
      data: result.rows[0],
      message: 'Lead created successfully'
    });

  } catch (error) {
    console.error('Create lead error:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Error handling middleware
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Something went wrong!' });
});

// 404 handler
app.use('*', (req, res) => {
  res.status(404).json({ error: 'Route not found' });
});

// Start server
app.listen(PORT, () => {
  console.log(`🚀 LeadSpark API server running on port ${PORT}`);
  console.log(`📊 Health check: http://localhost:${PORT}/api/health`);
});

// Graceful shutdown
process.on('SIGINT', () => {
  console.log('\n🛑 Shutting down server...');
  pool.end(() => {
    console.log('✅ Database connections closed');
    process.exit(0);
  });
});
