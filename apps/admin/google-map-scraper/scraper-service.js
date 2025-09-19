const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');

// Note: The original GoogleMapsScraper class is kept largely intact,
// but the CLI-specific logic (main function, argument parsing) is removed.
// It is now designed to be instantiated and used by another part of an application.

class GoogleMapsScraper {
    constructor() {
        // The data directory is now relative to this service file's location
        this.dataDir = path.join(__dirname, '..', 'data', 'map_data');
        this.browser = null;
        this.context = null;
        this.page = null;
    }

    // ... [ All the original methods of GoogleMapsScraper class go here ] ...
    // checkInternetConnection, saveData, loadCachedData, initialize, 
    // scrapeGoogleMaps, and exportToCSV methods are identical to the original scraper.js
    // For brevity, they are not repeated here but will be included in the actual file.

    /**
     * Check internet connectivity by pinging a reliable service
     */
    async checkInternetConnection(retryDelay = 5000) {
        const https = require('https');
        
        for (;;) {
            try {
                const response = await new Promise((resolve, reject) => {
                    const req = https.request('https://www.bing.com', { method: 'HEAD', timeout: 5000 }, (res) => {
                        resolve(res);
                    });
                    req.on('error', reject);
                    req.on('timeout', () => reject(new Error('Timeout')));
                    req.end();
                });
                
                if (response.statusCode === 200) {
                    console.log('✅ Internet connection verified');
                    return true;
                }
            } catch (error) {
                console.log('⏳ Waiting for internet connection...');
                await new Promise(resolve => setTimeout(resolve, retryDelay));
            }
        }
    }

    /**
     * Save scraped data to JSON file
     */
    saveData(businessData, query) {
        try {
            const filename = query.replace(/[^a-zA-Z0-9]/g, "_").toLowerCase();
            const filepath = path.join(this.dataDir, `${filename}.json`);
            let existingData = [];

            if (!fs.existsSync(this.dataDir)) {
                fs.mkdirSync(this.dataDir, { recursive: true });
            }

            if (fs.existsSync(filepath)) {
                const fileContent = fs.readFileSync(filepath, 'utf-8');
                if (fileContent.trim().length > 0) {
                    existingData = JSON.parse(fileContent);
                }
            }

            existingData.push(businessData);
            
            fs.writeFileSync(filepath, JSON.stringify(existingData, null, 2));
            console.log(`💾 Data saved to: ${filepath}`);
        } catch (error) {
            console.error('❌ Error writing file:', error.message);
        }
    }

    /**
     * Load cached data if available
     */
    loadCachedData(query) {
        try {
            const filename = query.replace(/[^a-zA-Z0-9]/g, "_").toLowerCase();
            const filepath = path.join(this.dataDir, `${filename}.json`);
            
            if (fs.existsSync(filepath)) {
                const fileContent = fs.readFileSync(filepath, 'utf-8');
                if (fileContent.trim().length > 0) {
                    const data = JSON.parse(fileContent);
                    console.log(`📁 Found cached data: ${data.length} businesses`);
                    return data;
                }
            }
        } catch (error) {
            console.error('❌ Error loading cached data:', error.message);
        }
        return null;
    }

    /**
     * Initialize browser and page
     */
    async initialize() {
        console.log('🚀 Initializing browser...');
        // In the Alpine environment, Playwright needs to be told which browser executable to use.
        // We installed 'chromium-browser' via apk in the Dockerfile.
        const browserOptions = {
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        };

        if (process.env.PLAYWRIGHT_BROWSERS_PATH) {
            browserOptions.executablePath = `${process.env.PLAYWRIGHT_BROWSERS_PATH}/chromium`;
        }
        
        this.browser = await chromium.launch(browserOptions);
        this.context = await this.browser.newContext({
            userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
        });
        this.page = await this.context.newPage();
        
        await this.page.setViewportSize({ width: 1920, height: 1080 });
    }

    /**
     * Main scraping function
     */
    async scrapeGoogleMaps(query, useCache = true, limit = null) { // --- MODIFICATION: Add limit parameter ---
        try {
            console.log(`🔍 Starting Google Maps scrape for: "${query}"`);
            
            if (useCache) {
                const cachedData = this.loadCachedData(query);
                if (cachedData) {
                    console.log('📁 Using cached data');
                    return cachedData;
                }
            }

            await this.initialize();
            
            await this.checkInternetConnection();

            console.log('🌐 Navigating to Google Maps...');
            await this.page.goto(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(query)}`, {
                waitUntil: 'domcontentloaded'
            });

            await this.page.waitForTimeout(3000);
            await this.page.waitForSelector('div[role="feed"]');
            
            await this.page.evaluate(() => {
                document.body.style.zoom = "0.67";
            });

            console.log('📜 Scrolling to load more results...');
            let endReached = false;
            let scrollAttempts = 0;
            const maxScrollAttempts = 20;

            while (!endReached && scrollAttempts < maxScrollAttempts) {
                await this.checkInternetConnection();
                
                await this.page.evaluate(() => {
                    const feed = document.querySelector('div[role="feed"]');
                    if (feed) {
                        feed.scrollBy(0, 500);
                    }
                });
                
                await this.page.waitForTimeout(1000 + Math.floor(500 * Math.random()));
                
                endReached = await this.page.evaluate(() => {
                    return document.querySelector("p.fontBodyMedium span.HlvSq") !== null;
                });
                
                scrollAttempts++;
                console.log(`📜 Scroll attempt ${scrollAttempts}/${maxScrollAttempts}`);
            }

            await this.page.evaluate(() => {
                document.body.style.zoom = "0.50";
            });

            console.log('🔍 Finding business listings...');
            const businessElements1 = await this.page.$$('div[role="feed"] div.Nv2PK.tH5CWc.THOPZb') || [];
            const businessElements2 = await this.page.$$('div[role="feed"] div.Nv2PK.Q2HXcd.THOPZb') || [];
            const businessElements3 = await this.page.$$('div[role="feed"] div.Nv2PK.THOPZb.CpccDe') || [];

            let businessElements = [];
            if (businessElements1.length && businessElements2.length) {
                businessElements = [...businessElements1, ...businessElements2];
            } else if (businessElements1.length) {
                businessElements = businessElements1;
            } else if (businessElements2.length) {
                businessElements = businessElements2;
            } else {
                businessElements = businessElements3;
            }

            console.log(`📊 Found ${businessElements.length} business listings`);

            const scrapedData = [];
            // --- MODIFICATION: Loop until the limit is reached ---
            for (let i = 0; i < businessElements.length; i++) {
                // If a limit is set and we have reached it, break the loop
                if (limit && scrapedData.length >= limit) {
                    console.log(`✅ Limit of ${limit} reached. Stopping scrape.`);
                    break;
                }

                try {
                    console.log(`📝 Processing business ${i + 1}/${businessElements.length}`);
                    
                    const businessElement = businessElements[i];
                    await this.checkInternetConnection();
                    
                    await businessElement.scrollIntoViewIfNeeded();
                    await businessElement.click();
                    await this.page.waitForTimeout(3000);
                    
                    await this.page.waitForSelector("div.m6QErb.DxyBCb.kA9KIf.dS8AEf.XiKgde", { timeout: 7000 });

                    const currentUrl = this.page.url();
                    const coordMatch = currentUrl.match(/@([0-9.-]+),([0-9.-]+)/);
                    const latitude = coordMatch ? coordMatch[1] : "";
                    const longitude = coordMatch ? coordMatch[2] : "";

                    const businessData = await this.page.evaluate(() => {
                        const getText = (selector) => document.querySelector(selector)?.innerText?.trim() || "";
                        const getAttribute = (selector, attr) => document.querySelector(selector)?.getAttribute(attr) || "";
                        const getSrc = (selector) => document.querySelector(selector)?.src || "";
                        const getPhoneNumber = (selector) => {
                            const phoneElement = document.querySelector(selector);
                            return phoneElement ? phoneElement.innerText.replace(/\D/g, "") : "";
                        };

                        return {
                            image: getSrc("button.aoRNLd img"),
                            title: getText("h1.DUwDvf"),
                            description: getText("h2.bwoZTb"),
                            category: getText("button.DkEaL"),
                            address: getText('[data-item-id="address"]'),
                            status: getText('div[aria-expanded="false"][role="button"] .o0Svhf'),
                            phone_num: getPhoneNumber('button[data-item-id^="phone:tel"]'),
                            avg_rating: getText('.dmRWX span[aria-hidden="true"]'),
                            reviews: getText('.dmRWX span[aria-label*="reviews"]'),
                            website: getAttribute('a[data-item-id="authority"]', 'href')
                        };
                    });

                    businessData.link = currentUrl;
                    businessData.latitude = latitude;
                    businessData.longitude = longitude;
                    businessData.scraped_at = new Date().toISOString();

                    this.saveData(businessData, query);
                    scrapedData.push(businessData);

                    await this.page.keyboard.press('Escape');
                    await this.page.waitForTimeout(2000);

                } catch (error) {
                    console.log(`⚠️  Skipping business ${i + 1} due to error: ${error.message}`);
                    continue;
                }
            }

            const uniqueData = [...new Set(scrapedData.map(item => JSON.stringify(item)))].map(item => JSON.parse(item));

            console.log(`✅ Scraping completed! Found ${uniqueData.length} unique businesses`);
            return uniqueData;

        } catch (error) {
            console.error('❌ Scraping Error:', error);
            throw error;
        } finally {
            if (this.browser) {
                await this.browser.close();
                console.log('🧹 Browser closed');
            }
        }
    }

    /**
     * Export data to CSV format
     */
    exportToCSV(data, filename) {
        if (!data || data.length === 0) {
            console.log('❌ No data to export');
            return;
        }

        const csvPath = path.join(this.dataDir, `${filename}.csv`);
        const headers = Object.keys(data[0]);
        
        let csvContent = headers.join(',') + '\n';
        
        data.forEach(business => {
            const row = headers.map(header => {
                const value = business[header] || '';
                return `"${value.toString().replace(/"/g, '""')}"`;
            });
            csvContent += row.join(',') + '\n';
        });

        fs.writeFileSync(csvPath, csvContent);
        console.log(`📊 Data exported to CSV: ${csvPath}`);
    }
}

// A new function to handle the API logic, which creates an instance of the scraper and runs it.
async function runScrape(params) {
    const { keyword, area, locality, pincode, radius, noCache = false, limit = null } = params; // --- MODIFICATION: Add limit ---

    // Construct the search query from the API parameters
    let locationParts = [locality, area, pincode].filter(Boolean).join(', ');
    let query = keyword;

    if (radius && locationParts) {
        query = `${keyword} within ${radius} miles of ${locationParts}`;
    } else if (locationParts) {
        query = `${keyword} in ${locationParts}`;
    }

    if (!query) {
        throw new Error('A keyword or a combination of location parameters is required.');
    }

    const scraper = new GoogleMapsScraper();
    const useCache = !noCache;
    
    // Run the scraper and return the results
    const results = await scraper.scrapeGoogleMaps(query, useCache, limit); // --- MODIFICATION: Pass limit ---
    return results;
}

module.exports = { runScrape };
