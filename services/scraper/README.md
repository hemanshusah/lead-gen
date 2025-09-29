# Google Maps Scraper Service

This service provides Google Maps scraping functionality with two execution modes:
1. **Direct Mode**: Runs scraping directly in the service
2. **Docker Mode**: Triggers Docker containers for scraping jobs

## Architecture

```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────────┐
│   API Gateway   │───▶│ Scraping Service │───▶│  Docker Container   │
│   (External)    │    │   (Port 3012)    │    │  (On-demand)       │
└─────────────────┘    └──────────────────┘    └─────────────────────┘
```

## Quick Start

### 1. Start the Service
```bash
# Start the scraping service
docker-compose up google-map-scraper-service

# Or run directly with Node.js
npm start
```

### 2. Test Direct Scraping
```bash
# Direct scraping (original mode)
curl "http://localhost:3012/scrape?keyword=restaurants&locality=New York&limit=5"
```

### 3. Test Docker Container Scraping
```bash
# Docker container scraping (new mode)
curl -X POST http://localhost:3012/scrape-docker \
  -H "Content-Type: application/json" \
  -d '{
    "params": {
      "keyword": "restaurants",
      "locality": "New York",
      "limit": 5
    }
  }'
```

## API Endpoints

### Health Check
```http
GET /
```
Returns service status and active job count.

### List All Jobs
```http
GET /jobs
```
Returns all jobs with their status.

### Get Job Status
```http
GET /job/:jobId
```
Returns specific job details and results.

### Direct Scraping (Original)
```http
GET /scrape?keyword=restaurants&locality=New York&limit=5
```
Runs scraping directly in the service.

### Docker Container Scraping (New)
```http
POST /scrape-docker
Content-Type: application/json

{
  "params": {
    "keyword": "restaurants",
    "locality": "New York",
    "limit": 5
  }
}
```
Triggers a Docker container for scraping.

## Supported Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `keyword` | string | ✅ | Search term (e.g., "restaurants") |
| `locality` | string | ❌ | City/location (e.g., "New York") |
| `area` | string | ❌ | Specific area (e.g., "Manhattan") |
| `pincode` | string | ❌ | Postal code (e.g., "10001") |
| `radius` | string | ❌ | Search radius in miles (e.g., "5") |
| `limit` | number | ❌ | Maximum results (e.g., 10) |
| `noCache` | boolean | ❌ | Skip cached data (default: false) |

## Usage Examples

### Example 1: Basic Restaurant Search
```bash
curl -X POST http://localhost:3012/scrape-docker \
  -H "Content-Type: application/json" \
  -d '{
    "params": {
      "keyword": "restaurants",
      "locality": "San Francisco",
      "limit": 10
    }
  }'
```

### Example 2: Coffee Shops in Specific Area
```bash
curl -X POST http://localhost:3012/scrape-docker \
  -H "Content-Type: application/json" \
  -d '{
    "params": {
      "keyword": "coffee shops",
      "area": "Manhattan",
      "locality": "New York",
      "limit": 5
    }
  }'
```

### Example 3: Hotels with Radius Search
```bash
curl -X POST http://localhost:3012/scrape-docker \
  -H "Content-Type: application/json" \
  -d '{
    "params": {
      "keyword": "hotels",
      "locality": "Los Angeles",
      "radius": "10",
      "limit": 15
    }
  }'
```

## Response Format

### Job Started Response
```json
{
  "message": "Docker scraping job started successfully",
  "jobId": "job_1703123456789_abc123",
  "status": "running",
  "mode": "docker",
  "params": {
    "keyword": "restaurants",
    "locality": "New York",
    "limit": 5
  },
  "createdAt": "2023-12-21T10:30:45.123Z"
}
```

### Job Status Response
```json
{
  "jobId": "job_1703123456789_abc123",
  "status": "completed",
  "mode": "docker",
  "params": {
    "keyword": "restaurants",
    "locality": "New York",
    "limit": 5
  },
  "createdAt": "2023-12-21T10:30:45.123Z",
  "completedAt": "2023-12-21T10:32:15.456Z",
  "result": {
    "jobId": "job_1703123456789_abc123",
    "scraperType": "google-map-scraper",
    "status": "completed",
    "results": [...],
    "count": 5,
    "completedAt": "2023-12-21T10:32:15.456Z",
    "parameters": {...}
  }
}
```

## Docker Container Details

### Container Image
- **Image Name**: `google-map-scraper:latest`
- **Base Image**: `node:20-alpine`
- **Browser**: Chromium with Playwright
- **Entry Point**: `container-runner.js`

### Container Execution
```bash
docker run --rm \
  -v /path/to/jobs:/app/data \
  -e JOB_ID=job_123 \
  google-map-scraper:latest
```

### Container Environment Variables
- `JOB_ID`: Unique job identifier
- `PLAYWRIGHT_BROWSERS_PATH`: Browser executable path

## Directory Structure

```
google-map-scraper/
├── index.js                 # Main API server
├── container-runner.js      # Docker container entry point
├── scraper-service.js       # Core scraping logic
├── package.json             # Dependencies
├── Dockerfile              # Container configuration
├── docker-compose.yml       # Service orchestration
├── jobs/                    # Job data (auto-created)
│   └── job_*/              # Individual job directories
└── data/                    # Scraped results
    └── map_data/           # Google Maps results
```

## Development

### Local Development
```bash
# Install dependencies
npm install

# Start the service
npm start

# Test endpoints
curl http://localhost:3012/
```

### Docker Development
```bash
# Build the image
docker build -t google-map-scraper:latest .

# Test the container
docker run --rm -v $(pwd)/jobs:/app/data -e JOB_ID=test google-map-scraper:latest
```

### Docker Compose
```bash
# Start the service
docker-compose up google-map-scraper-service

# Start with logs
docker-compose up -d google-map-scraper-service
docker-compose logs -f google-map-scraper-service
```

## Monitoring and Logs

### View Service Logs
```bash
# Docker Compose logs
docker-compose logs -f google-map-scraper-service

# Direct container logs
docker logs google-map-scraper-service
```

### View Job Data
```bash
# List all jobs
ls -la jobs/

# View specific job
cat jobs/job_*/result.json
```

### Clean Up Old Jobs
```bash
# Remove old job directories
rm -rf jobs/job_*
```

## Troubleshooting

### Common Issues

1. **Container not starting**: Check Docker logs
2. **Permission errors**: Ensure proper volume mounts
3. **Network issues**: Check Docker network configuration
4. **Job stuck**: Check container logs and restart if needed

### Debug Commands
```bash
# Check running containers
docker ps

# View container logs
docker logs <container_id>

# Execute shell in container
docker exec -it <container_id> /bin/sh

# Check job files
ls -la jobs/job_*/
```

### Health Checks
```bash
# Service health
curl http://localhost:3012/

# Job status
curl http://localhost:3012/jobs

# Specific job
curl http://localhost:3012/job/JOB_ID
```

## Production Considerations

1. **Use Redis/Database**: Replace in-memory job storage
2. **Add Authentication**: Secure API endpoints
3. **Implement Rate Limiting**: Prevent abuse
4. **Add Monitoring**: Prometheus/Grafana integration
5. **Use Kubernetes**: For better orchestration
6. **Add Health Checks**: Container health monitoring

## Integration with API Gateway

This service is designed to be called by an external API Gateway:

```javascript
// API Gateway calls this service
const response = await fetch('http://localhost:3012/scrape-docker', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    params: {
      keyword: 'restaurants',
      locality: 'New York',
      limit: 10
    }
  })
});

const { jobId } = await response.json();

// Check job status
const status = await fetch(`http://localhost:3012/job/${jobId}`);
const jobStatus = await status.json();
```

This architecture allows for:
- **Scalability**: Multiple containers can run simultaneously
- **Isolation**: Each scraping job runs in its own container
- **Monitoring**: Job status tracking and result collection
- **Flexibility**: Both direct and containerized execution modes
