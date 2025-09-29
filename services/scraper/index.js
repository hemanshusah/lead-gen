const express = require('express');
const cors = require('cors');
const { exec } = require('child_process');
const { promisify } = require('util');
const fs = require('fs');
const path = require('path');
const { runScrape } = require('./scraper-service'); // Import the scraper service

const execAsync = promisify(exec);

// Initialize the Express application
const app = express();
const port = process.env.PORT || 3012;

// Job status storage (in production, use Redis/Database)
const jobStatus = new Map();

// Ensure jobs directory exists
const jobsDir = path.join(__dirname, 'jobs');
if (!fs.existsSync(jobsDir)) {
  fs.mkdirSync(jobsDir, { recursive: true });
}

// --- Middleware ---
// Enable Cross-Origin Resource Sharing (CORS) for all routes
app.use(cors());
// Enable parsing of JSON request bodies
app.use(express.json());
// Enable parsing of URL-encoded request bodies
app.use(express.urlencoded({ extended: true }));

// --- Routes ---
// Health check route
app.get('/', (req, res) => {
  res.status(200).json({
    message: 'Google Maps Scraper Service - Docker Container Trigger',
    status: 'ok',
    timestamp: new Date().toISOString(),
    activeJobs: jobStatus.size,
    supportedModes: ['direct', 'docker']
  });
});

// List all jobs
app.get('/jobs', (req, res) => {
  const jobs = Array.from(jobStatus.entries()).map(([jobId, job]) => ({
    jobId,
    ...job
  }));
  
  res.json({
    totalJobs: jobs.length,
    jobs
  });
});

// Get specific job status
app.get('/job/:jobId', (req, res) => {
  const { jobId } = req.params;
  const job = jobStatus.get(jobId);
  
  if (!job) {
    return res.status(404).json({ 
      error: 'Job not found',
      jobId 
    });
  }
  
  res.json({
    jobId,
    ...job
  });
});

// --- Docker Container Trigger Route ---
app.post('/scrape-docker', async (req, res) => {
  const { params } = req.body;
  
  if (!params || !params.keyword) {
    return res.status(400).json({ 
      error: 'Parameters with keyword are required',
      example: {
        params: {
          keyword: 'restaurants',
          locality: 'New York',
          limit: 10
        }
      }
    });
  }

  const jobId = `job_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
  
  try {
    console.log(`🚀 Starting Docker scraping job: ${jobId}`);
    
    // Update job status
    jobStatus.set(jobId, {
      status: 'running',
      mode: 'docker',
      params,
      createdAt: new Date().toISOString(),
      result: null,
      error: null
    });

    // Trigger Docker container asynchronously
    triggerDockerContainer(jobId, params);

    res.json({
      message: 'Docker scraping job started successfully',
      jobId,
      status: 'running',
      mode: 'docker',
      params,
      createdAt: new Date().toISOString()
    });

  } catch (error) {
    console.error('Error starting Docker job:', error);
    res.status(500).json({ 
      error: 'Failed to start Docker scraping job',
      details: error.message 
    });
  }
});

// --- Direct Scraper Route (Original) ---
app.get('/scrape', async (req, res) => {
  console.log('Received scrape request with params:', req.query);

  // Extract query parameters from the request URL
  const { keyword, area, locality, pincode, radius, noCache, limit } = req.query; // --- MODIFICATION: Add limit ---

  if (!keyword) {
    return res.status(400).json({ error: 'The "keyword" query parameter is required.' });
  }

  try {
    // Call the scraper service with the provided parameters
    const results = await runScrape({
      keyword,
      area,
      locality,
      pincode,
      radius,
      noCache: noCache === 'true',
      limit: limit ? parseInt(limit, 10) : null, // --- MODIFICATION: Parse limit as an integer ---
    });

    // Send the results back as a JSON response
    res.status(200).json({
      message: 'Scraping completed successfully.',
      query: req.query,
      resultsCount: results.length,
      data: results,
    });

  } catch (error) {
    console.error('API Error during scraping:', error);
    // Send a generic server error response
    res.status(500).json({
      message: 'An error occurred during the scraping process.',
      error: error.message,
    });
  }
});

// --- Docker Container Trigger Function ---
async function triggerDockerContainer(jobId, params) {
  try {
    console.log(`🔧 Setting up Docker job directory for ${jobId}`);
    
    // Create job directory
    const jobDir = path.join(jobsDir, jobId);
    fs.mkdirSync(jobDir, { recursive: true });
    
    // Write parameters to file
    const paramsFile = path.join(jobDir, 'params.json');
    fs.writeFileSync(paramsFile, JSON.stringify(params, null, 2));
    
    console.log(`📝 Parameters saved to: ${paramsFile}`);
    
    // Execute Docker container
    const dockerCmd = `docker run --rm \
      -v ${jobDir}:/app/data \
      -e JOB_ID=${jobId} \
      google-map-scraper:latest`;
    
    console.log(`🐳 Executing Docker command: ${dockerCmd}`);
    
    // Execute asynchronously
    exec(dockerCmd, (error, stdout, stderr) => {
      if (error) {
        console.error(`❌ Docker execution failed for job ${jobId}:`, error);
        jobStatus.set(jobId, {
          ...jobStatus.get(jobId),
          status: 'failed',
          error: error.message,
          failedAt: new Date().toISOString()
        });
        return;
      }
      
      console.log(`📊 Docker stdout for job ${jobId}:`, stdout);
      if (stderr) {
        console.log(`⚠️ Docker stderr for job ${jobId}:`, stderr);
      }
      
      // Check for results
      const resultFile = path.join(jobDir, 'result.json');
      const errorFile = path.join(jobDir, 'error.json');
      
      if (fs.existsSync(resultFile)) {
        try {
          const result = JSON.parse(fs.readFileSync(resultFile, 'utf8'));
          jobStatus.set(jobId, {
            ...jobStatus.get(jobId),
            status: 'completed',
            result,
            completedAt: new Date().toISOString()
          });
          console.log(`✅ Job ${jobId} completed successfully with ${result.count || 0} results`);
        } catch (parseError) {
          console.error(`❌ Error parsing result file for job ${jobId}:`, parseError);
          jobStatus.set(jobId, {
            ...jobStatus.get(jobId),
            status: 'failed',
            error: 'Failed to parse result file',
            failedAt: new Date().toISOString()
          });
        }
      } else if (fs.existsSync(errorFile)) {
        try {
          const errorData = JSON.parse(fs.readFileSync(errorFile, 'utf8'));
          jobStatus.set(jobId, {
            ...jobStatus.get(jobId),
            status: 'failed',
            error: errorData.error,
            failedAt: new Date().toISOString()
          });
          console.log(`❌ Job ${jobId} failed with error: ${errorData.error}`);
        } catch (parseError) {
          console.error(`❌ Error parsing error file for job ${jobId}:`, parseError);
          jobStatus.set(jobId, {
            ...jobStatus.get(jobId),
            status: 'failed',
            error: 'Unknown error occurred',
            failedAt: new Date().toISOString()
          });
        }
      } else {
        console.log(`⚠️ No result or error file found for job ${jobId}`);
        jobStatus.set(jobId, {
          ...jobStatus.get(jobId),
          status: 'completed',
          result: { message: 'No results found' },
          completedAt: new Date().toISOString()
        });
      }
    });
    
  } catch (error) {
    console.error(`❌ Error setting up Docker job ${jobId}:`, error);
    jobStatus.set(jobId, {
      ...jobStatus.get(jobId),
      status: 'failed',
      error: error.message,
      failedAt: new Date().toISOString()
    });
  }
}

// Cleanup old jobs (run every hour)
setInterval(() => {
  const oneHourAgo = Date.now() - (60 * 60 * 1000);
  const jobsToDelete = [];
  
  for (const [jobId, job] of jobStatus.entries()) {
    const jobTime = new Date(job.createdAt).getTime();
    if (jobTime < oneHourAgo && (job.status === 'completed' || job.status === 'failed')) {
      jobsToDelete.push(jobId);
    }
  }
  
  jobsToDelete.forEach(jobId => {
    const jobDir = path.join(jobsDir, jobId);
    if (fs.existsSync(jobDir)) {
      fs.rmSync(jobDir, { recursive: true, force: true });
    }
    jobStatus.delete(jobId);
  });
  
  if (jobsToDelete.length > 0) {
    console.log(`🧹 Cleaned up ${jobsToDelete.length} old jobs`);
  }
}, 60 * 60 * 1000); // Run every hour

// --- Server Startup ---
app.listen(port, () => {
  console.log(`🚀 Google Maps Scraper Service running on http://localhost:${port}`);
  console.log('📋 Available endpoints:');
  console.log('  GET  / - Health check');
  console.log('  GET  /jobs - List all jobs');
  console.log('  GET  /job/:jobId - Get job status');
  console.log('  GET  /scrape - Direct scraping (original)');
  console.log('  POST /scrape-docker - Docker container scraping');
  console.log('🔧 Ready to receive scraping requests!');
});

// Export the app for potential testing or extension
module.exports = app;
