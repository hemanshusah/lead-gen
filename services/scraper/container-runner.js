const { runScrape } = require('./scraper-service');
const fs = require('fs');
const path = require('path');

/**
 * Container runner for Google Maps scraper
 * This script runs inside the Docker container and handles:
 * - Reading job parameters
 * - Executing the scraping logic
 * - Saving results to the shared volume
 * - Error handling and reporting
 */
async function main() {
  const jobId = process.env.JOB_ID;
  const dataDir = '/app/data';
  
  if (!jobId) {
    console.error('❌ JOB_ID environment variable is required');
    process.exit(1);
  }
  
  console.log(`🔍 Starting Google Maps scraper job: ${jobId}`);
  console.log(`📁 Data directory: ${dataDir}`);
  
  try {
    // Check if data directory exists
    if (!fs.existsSync(dataDir)) {
      throw new Error(`Data directory does not exist: ${dataDir}`);
    }
    
    // Read parameters
    const paramsFile = path.join(dataDir, 'params.json');
    if (!fs.existsSync(paramsFile)) {
      throw new Error(`Parameters file not found: ${paramsFile}`);
    }
    
    const params = JSON.parse(fs.readFileSync(paramsFile, 'utf8'));
    console.log('📋 Job parameters:', JSON.stringify(params, null, 2));
    
    // Validate required parameters
    if (!params.keyword) {
      throw new Error('keyword parameter is required');
    }
    
    console.log(`🌐 Starting Google Maps scrape for: "${params.keyword}"`);
    
    // Run scraping
    const results = await runScrape(params);
    
    console.log(`✅ Scraping completed: ${results.length} results found`);
    
    // Save results
    const resultFile = path.join(dataDir, 'result.json');
    const resultData = {
      jobId,
      scraperType: 'google-map-scraper',
      status: 'completed',
      results,
      count: results.length,
      completedAt: new Date().toISOString(),
      parameters: params
    };
    
    fs.writeFileSync(resultFile, JSON.stringify(resultData, null, 2));
    console.log(`💾 Results saved to: ${resultFile}`);
    
    // Log summary
    console.log('📊 Scraping Summary:');
    console.log(`  - Job ID: ${jobId}`);
    console.log(`  - Query: ${params.keyword}`);
    console.log(`  - Results: ${results.length}`);
    console.log(`  - Location: ${params.locality || 'N/A'}`);
    console.log(`  - Limit: ${params.limit || 'No limit'}`);
    
    // Show sample results (first 3)
    if (results.length > 0) {
      console.log('📋 Sample results:');
      results.slice(0, 3).forEach((result, index) => {
        console.log(`  ${index + 1}. ${result.title || 'N/A'} - ${result.address || 'N/A'}`);
      });
    }
    
    console.log(`🎉 Job ${jobId} completed successfully!`);
    
    // Explicitly exit the process after successful completion
    console.log('🔄 Exiting container after successful completion...');
    forceExit();
    
  } catch (error) {
    console.error(`❌ Scraping failed for job ${jobId}:`, error.message);
    
    // Save error details
    const errorFile = path.join(dataDir, 'error.json');
    const errorData = {
      jobId,
      scraperType: 'google-map-scraper',
      status: 'failed',
      error: error.message,
      stack: error.stack,
      failedAt: new Date().toISOString(),
      parameters: params || {}
    };
    
    fs.writeFileSync(errorFile, JSON.stringify(errorData, null, 2));
    console.log(`💾 Error details saved to: ${errorFile}`);
    
    process.exit(1);
  }
}

// Handle process signals for graceful shutdown
process.on('SIGINT', () => {
  console.log('🛑 Received SIGINT, shutting down gracefully...');
  process.exit(0);
});

process.on('SIGTERM', () => {
  console.log('🛑 Received SIGTERM, shutting down gracefully...');
  process.exit(0);
});

// Force exit after a short delay to ensure cleanup
function forceExit() {
  console.log('🔄 Forcing process exit...');
  setTimeout(() => {
    console.log('💀 Force killing process...');
    process.exit(0);
  }, 1000);
}

// Handle uncaught exceptions
process.on('uncaughtException', (error) => {
  console.error('💥 Uncaught Exception:', error);
  process.exit(1);
});

process.on('unhandledRejection', (reason, promise) => {
  console.error('💥 Unhandled Rejection at:', promise, 'reason:', reason);
  process.exit(1);
});

// Set a maximum execution timeout (10 minutes)
const MAX_EXECUTION_TIME = 10 * 60 * 1000; // 10 minutes
setTimeout(() => {
  console.log('⏰ Maximum execution time reached, forcing container exit...');
  process.exit(1);
}, MAX_EXECUTION_TIME);

// Run the main function
main().catch((error) => {
  console.error('💥 Fatal error in main:', error);
  process.exit(1);
});
