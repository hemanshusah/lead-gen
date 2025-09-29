# LeadSpark - Lead Generation Platform

LeadSpark is a powerful AI-powered platform that helps businesses generate, manage, and convert high-quality leads across various industries.

## Features

- **AI-Powered Lead Generation**: Identify and target high-intent prospects
- **Multi-Industry Support**: Real estate, SaaS, e-commerce, B2B sales, and more
- **Automated Follow-ups**: Personalized nurturing sequences
- **CRM Integration**: Seamless integration with popular CRMs
- **Analytics Dashboard**: Comprehensive lead tracking and ROI metrics

## Tech Stack

- **Frontend**: React, HTML5, CSS3, JavaScript
- **Backend**: Node.js, Express.js
- **Database**: PostgreSQL
- **Authentication**: JWT-based authentication
- **Package Manager**: Yarn (as per CTO requirements)
- **Deployment**: Static hosting ready

## Prerequisites

- Node.js (v16 or higher)
- Yarn package manager
- Python 3 (for frontend serving)
- PostgreSQL database access

## Quick Start

### 1. Install Dependencies
```bash
# Navigate to landing directory
cd apps/landing

# Install Yarn globally (if not already installed)
npm install -g yarn

# Install project dependencies
yarn install
```

### 2. Configure Database
- Database credentials are already configured in `server.js`
- Ensure PostgreSQL database is accessible
- Database: `leadgen` on host `62.72.57.136`

### 3. Start the Application

#### Option A: Start Both Services (Recommended)
```bash
# Start both backend and frontend
yarn serve
```

#### Option B: Start Services Separately
```bash
# Terminal 1: Start backend server
yarn start

# Terminal 2: Start frontend server
yarn frontend
```

### 4. Access the Application
- **Frontend**: http://localhost:8010
- **Backend API**: http://localhost:3001
- **Health Check**: http://localhost:3001/api/health

## Available Scripts

- `yarn start` - Start the backend server
- `yarn dev` - Start backend in development mode with nodemon
- `yarn frontend` - Start frontend static server
- `yarn serve` - Start both backend and frontend
- `yarn build` - Build command (no build step required for static site)

## Development Workflow

### Making Changes
1. Create a new branch: `git checkout -b feature/your-feature-name`
2. Make your changes
3. Test locally: `yarn serve`
4. Commit changes: `git add . && git commit -m "Description of changes"`
5. Push branch: `git push origin feature/your-feature-name`
6. Create Pull Request on GitHub

### Code Structure
```
landing/
├── public/                # Static assets and images
│   ├── logo.png
│   ├── bg1.png
│   ├── bg2.png
│   └── leadspark-in-action.png
├── assets/                # Compiled frontend assets
├── server.js              # Backend API server
├── api-service.js         # Frontend API service
├── config.js              # Configuration file
├── index.html             # Main landing page
├── package.json           # Dependencies and scripts
├── yarn.lock             # Yarn lockfile
└── README.md             # This file
```

## API Endpoints

- `GET /api/health` - Health check
- `POST /api/waitlist` - Add to waitlist
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User authentication
- `GET /api/auth/profile` - Get user profile (protected)
- `GET /api/leads` - Get user leads (protected)
- `POST /api/leads` - Create new lead (protected)

## Production Deployment

This application is ready for static hosting deployment:

- **Frontend**: Deploy the root directory to any static hosting service
- **Backend**: Deploy the Node.js server to your preferred hosting platform
- **Database**: PostgreSQL database is already configured

## Troubleshooting

### Common Issues
1. **Port already in use**: Kill existing processes on ports 3001 or 8010
2. **Database connection failed**: Check PostgreSQL credentials in `server.js`
3. **Yarn not found**: Install yarn globally with `npm install -g yarn`

### Health Checks
```bash
# Check backend health
curl http://localhost:3001/api/health

# Check frontend
curl -I http://localhost:8010
```

## Support

For support and questions, please contact the LeadSpark team.

---

© 2024 LeadSpark. All rights reserved.
