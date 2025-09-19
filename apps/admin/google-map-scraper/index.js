const express = require('express');
const cors = require('cors');
const { runScrape } = require('./scraper-service'); // Import the scraper service

// Initialize the Express application
const app = express();
const port = process.env.PORT || 3000;

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
    message: 'Welcome to the Google Maps Scraper API!',
    status: 'ok',
    timestamp: new Date().toISOString(),
  });
});

// --- Scraper Route ---
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

// --- Server Startup ---
app.listen(port, () => {
  console.log(`🚀 Server is running on http://localhost:${port}`);
  console.log('API is ready to receive requests.');
});

// Export the app for potential testing or extension
module.exports = app;
