// LeadSpark API Service - Replaces Supabase
class LeadSparkAPI {
  constructor() {
    this.baseURL = 'http://localhost:3001/api';
    this.token = localStorage.getItem('leadspark_token');
  }

  // Set authentication token
  setToken(token) {
    this.token = token;
    if (token) {
      localStorage.setItem('leadspark_token', token);
    } else {
      localStorage.removeItem('leadspark_token');
    }
  }

  // Get authentication headers
  getHeaders() {
    const headers = {
      'Content-Type': 'application/json',
    };
    
    if (this.token) {
      headers['Authorization'] = `Bearer ${this.token}`;
    }
    
    return headers;
  }

  // Make API request
  async request(endpoint, options = {}) {
    const url = `${this.baseURL}${endpoint}`;
    const config = {
      headers: this.getHeaders(),
      ...options
    };

    try {
      const response = await fetch(url, config);
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.error || `HTTP ${response.status}`);
      }

      return data;
    } catch (error) {
      console.error('API Error:', error);
      throw error;
    }
  }

  // Waitlist API
  async addToWaitlist(email, name, phone, source = 'landing_page', metadata = {}) {
    return this.request('/waitlist', {
      method: 'POST',
      body: JSON.stringify({
        email,
        name,
        phone,
        source,
        metadata: {
          user_agent: navigator.userAgent,
          timestamp: new Date().toISOString(),
          referrer: document.referrer || 'direct',
          ...metadata
        }
      })
    });
  }

  async getWaitlistStats() {
    return this.request('/waitlist/stats');
  }

  // Authentication API
  async register(email, name, phone, password) {
    const response = await this.request('/auth/register', {
      method: 'POST',
      body: JSON.stringify({ email, name, phone, password })
    });

    if (response.success && response.data.token) {
      this.setToken(response.data.token);
    }

    return response;
  }

  async login(email, password) {
    const response = await this.request('/auth/login', {
      method: 'POST',
      body: JSON.stringify({ email, password })
    });

    if (response.success && response.data.token) {
      this.setToken(response.data.token);
    }

    return response;
  }

  async logout() {
    this.setToken(null);
  }

  async getProfile() {
    return this.request('/auth/profile');
  }

  // Leads API
  async getLeads() {
    return this.request('/leads');
  }

  async createLead(leadData) {
    return this.request('/leads', {
      method: 'POST',
      body: JSON.stringify(leadData)
    });
  }

  // Health check
  async healthCheck() {
    return this.request('/health');
  }

  // Check if user is authenticated
  isAuthenticated() {
    return !!this.token;
  }
}

// Create global instance
window.LeadSparkAPI = new LeadSparkAPI();

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
  module.exports = LeadSparkAPI;
}
