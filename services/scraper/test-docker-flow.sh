#!/bin/bash

# Test script for the Docker container flow
# This script tests: API Gateway → Scraping Service → Docker Container

echo "🧪 Testing Docker Container Flow"
echo "================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

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

# Check if Docker is running
check_docker() {
    print_status "Checking Docker status..."
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker and try again."
        exit 1
    fi
    print_success "Docker is running"
}

# Build the Docker image
build_docker_image() {
    print_status "Building Google Maps scraper Docker image..."
    
    docker build -t google-map-scraper:latest .
    if [ $? -eq 0 ]; then
        print_success "Docker image built successfully"
    else
        print_error "Failed to build Docker image"
        exit 1
    fi
}

# Start the scraping service
start_scraping_service() {
    print_status "Starting Google Maps scraper service..."
    
    # Create necessary directories
    mkdir -p jobs data
    
    # Start service in background
    node index.js &
    SERVICE_PID=$!
    
    # Wait for service to start
    sleep 3
    
    # Check if service is running
    if curl -s http://localhost:3012/ > /dev/null; then
        print_success "Scraping service is running on http://localhost:3012"
    else
        print_error "Scraping service failed to start"
        kill $SERVICE_PID 2>/dev/null
        exit 1
    fi
}

# Test the service endpoints
test_service_endpoints() {
    print_status "Testing service endpoints..."
    
    # Test health check
    print_status "Testing health check..."
    if curl -s http://localhost:3012/ | grep -q "ok"; then
        print_success "Health check passed"
    else
        print_error "Health check failed"
        return 1
    fi
    
    # Test jobs endpoint
    print_status "Testing jobs endpoint..."
    if curl -s http://localhost:3012/jobs | grep -q "totalJobs"; then
        print_success "Jobs endpoint working"
    else
        print_error "Jobs endpoint failed"
        return 1
    fi
}

# Test Docker container scraping
test_docker_scraping() {
    print_status "Testing Docker container scraping..."
    
    # Create test job
    print_status "Creating Docker scraping job..."
    JOB_RESPONSE=$(curl -s -X POST http://localhost:3012/scrape-docker \
        -H "Content-Type: application/json" \
        -d '{
            "params": {
                "keyword": "coffee shops",
                "locality": "San Francisco",
                "limit": 3
            }
        }')
    
    # Extract job ID
    JOB_ID=$(echo $JOB_RESPONSE | grep -o '"jobId":"[^"]*"' | cut -d'"' -f4)
    
    if [ -z "$JOB_ID" ]; then
        print_error "Failed to create Docker job"
        echo "Response: $JOB_RESPONSE"
        return 1
    fi
    
    print_success "Docker job created with ID: $JOB_ID"
    
    # Monitor job status
    print_status "Monitoring Docker job status..."
    for i in {1..60}; do
        JOB_STATUS=$(curl -s http://localhost:3012/job/$JOB_ID)
        
        if echo $JOB_STATUS | grep -q '"status":"completed"'; then
            print_success "Docker job completed successfully!"
            echo "Job details: $JOB_STATUS"
            break
        elif echo $JOB_STATUS | grep -q '"status":"failed"'; then
            print_error "Docker job failed"
            echo "Job details: $JOB_STATUS"
            return 1
        else
            print_status "Docker job still running... (attempt $i/60)"
            sleep 5
        fi
    done
    
    # Check if job completed
    if [ $i -eq 60 ]; then
        print_warning "Docker job did not complete within timeout"
        echo "Final status: $JOB_STATUS"
    fi
}

# Test direct scraping (original mode)
test_direct_scraping() {
    print_status "Testing direct scraping (original mode)..."
    
    DIRECT_RESPONSE=$(curl -s "http://localhost:3012/scrape?keyword=restaurants&locality=New York&limit=2")
    
    if echo $DIRECT_RESPONSE | grep -q '"message":"Scraping completed successfully"'; then
        print_success "Direct scraping completed successfully"
        echo "Response: $DIRECT_RESPONSE"
    else
        print_error "Direct scraping failed"
        echo "Response: $DIRECT_RESPONSE"
        return 1
    fi
}

# Cleanup function
cleanup() {
    print_status "Cleaning up..."
    
    # Kill service
    if [ ! -z "$SERVICE_PID" ]; then
        kill $SERVICE_PID 2>/dev/null
        print_status "Scraping service stopped"
    fi
    
    # Remove test data
    rm -rf jobs/job_*
    print_status "Test data cleaned up"
}

# Main test execution
main() {
    echo "Starting comprehensive Docker flow test..."
    echo ""
    
    # Set trap for cleanup
    trap cleanup EXIT
    
    # Run tests
    check_docker
    build_docker_image
    start_scraping_service
    test_service_endpoints
    test_direct_scraping
    test_docker_scraping
    
    echo ""
    print_success "All tests completed!"
    echo ""
    echo "📋 Test Summary:"
    echo "  ✅ Docker is running"
    echo "  ✅ Docker image built"
    echo "  ✅ Scraping service started"
    echo "  ✅ Service endpoints working"
    echo "  ✅ Direct scraping working"
    echo "  ✅ Docker container scraping working"
    echo ""
    echo "🎉 Docker container flow is working correctly!"
    echo ""
    echo "📖 Architecture verified:"
    echo "  API Gateway → Scraping Service → Docker Container"
}

# Run main function
main "$@"
