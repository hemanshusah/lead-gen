#!/bin/bash

# Script to insert sample data into the Lead Generation API Gateway database
# This script connects to the Supabase PostgreSQL database and inserts sample data

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Database connection parameters
DB_HOST="localhost"
DB_PORT="5432"
DB_NAME="ledgen"
DB_USER="postgres"
DB_PASSWORD=""

print_status "Starting sample data insertion for Lead Generation API Gateway..."
echo

# Check if psql is available
if ! command -v psql &> /dev/null; then
    print_error "PostgreSQL client (psql) is not installed."
    print_error "Please install PostgreSQL client tools to run this script."
    exit 1
fi

# Test database connection
print_status "Testing database connection..."
if ! PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -c "SELECT 1;" &> /dev/null; then
    print_error "Cannot connect to database."
    print_error "Please check your database connection parameters."
    exit 1
fi
print_success "Database connection successful!"

# Execute the SQL script
print_status "Inserting sample data..."
if PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -f "insert-sample-data.sql"; then
    print_success "Sample data inserted successfully!"
else
    print_error "Failed to insert sample data."
    exit 1
fi

echo
print_success "🎉 Sample data insertion completed!"
echo
print_status "Sample data includes:"
echo "  ✅ 3 Sample Accounts (TechCorp, Marketing Agency Pro, StartupXYZ)"
echo "  ✅ 5 Sample Users with different roles"
echo "  ✅ 5 Lead Sources (Google Maps, LinkedIn, Yelp, Facebook, Twitter)"
echo "  ✅ 9 Account Lead Source configurations"
echo "  ✅ 8 Saved Input presets"
echo "  ✅ 8 Crawl Jobs with different statuses"
echo "  ✅ 6 Job Runs with execution history"
echo
print_status "You can now test the API endpoints with real data!"
echo
print_status "Test endpoints:"
echo "  🔗 GET /api/v1/lead-sources"
echo "  🔗 GET /api/v1/saved-inputs"
echo "  🔗 GET /api/v1/crawl-jobs"
echo "  🔗 POST /api/v1/auth/login"
echo
print_status "Sample login credentials:"
echo "  📧 Email: john@techcorp.com"
echo "  🔑 Password: password"
echo "  📧 Email: sarah@techcorp.com"
echo "  🔑 Password: password"
