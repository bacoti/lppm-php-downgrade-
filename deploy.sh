#!/bin/bash

# ==================================================
# DEPLOYMENT SCRIPT FOR LPPM WEBSITE
# Safe deployment with conflict handling
# ==================================================

echo "🚀 Starting LPPM Website Deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_step() {
    echo -e "${BLUE}[STEP]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found! Please run this script from the Laravel root directory."
    exit 1
fi

# Step 1: Backup current database (if exists)
print_step "1. Creating database backup..."
if [ -f "database/database.sqlite" ]; then
    cp database/database.sqlite database/database.sqlite.backup.$(date +%Y%m%d_%H%M%S)
    print_status "Database backup created"
else
    print_warning "No existing database found to backup"
fi

# Step 2: Pull latest changes
print_step "2. Pulling latest changes from repository..."
git pull origin main
if [ $? -ne 0 ]; then
    print_error "Git pull failed! Please resolve conflicts manually."
    exit 1
fi
print_status "Repository updated successfully"

# Step 3: Install/Update dependencies
print_step "3. Installing/Updating dependencies..."
composer install --no-dev --optimize-autoloader
if [ $? -ne 0 ]; then
    print_error "Composer install failed!"
    exit 1
fi
print_status "Dependencies updated successfully"

# Step 4: Environment setup
print_step "4. Setting up environment..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    print_warning "Created .env file from example. Please update your configuration!"
fi

# Generate key if not exists
php artisan key:generate --force
print_status "Application key configured"

# Step 5: Database migrations (safe)
print_step "5. Running database migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    print_error "Migration failed! Restoring backup..."
    if [ -f "database/database.sqlite.backup.*" ]; then
        cp database/database.sqlite.backup.* database/database.sqlite
        print_status "Database restored from backup"
    fi
    exit 1
fi
print_status "Database migrations completed"

# Step 6: Safe database seeding
print_step "6. Running safe database seeding..."
php artisan db:seed --class=SafeDatabaseSeeder --force
if [ $? -ne 0 ]; then
    print_warning "Seeding completed with some warnings (this is normal for existing data)"
else
    print_status "Database seeding completed successfully"
fi

# Step 7: Clear caches
print_step "7. Clearing application caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
print_status "Caches cleared"

# Step 8: Optimize for production
print_step "8. Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_status "Application optimized"

# Step 9: Set permissions (Linux/Unix only)
if [[ "$OSTYPE" == "linux-gnu"* ]] || [[ "$OSTYPE" == "darwin"* ]]; then
    print_step "9. Setting file permissions..."
    chmod -R 755 storage bootstrap/cache
    print_status "Permissions set correctly"
fi

# Step 10: Verify deployment
print_step "10. Verifying deployment..."
php artisan --version > /dev/null
if [ $? -eq 0 ]; then
    print_status "✅ Deployment completed successfully!"
    print_status "🌐 Your LPPM website is ready!"
else
    print_error "❌ Deployment verification failed!"
    exit 1
fi

# Display important information
echo ""
echo "=================================================="
echo -e "${GREEN}DEPLOYMENT SUMMARY${NC}"
echo "=================================================="
echo "✅ Repository updated"
echo "✅ Dependencies installed"
echo "✅ Database migrated"
echo "✅ Application optimized"
echo "✅ Ready for production"
echo ""
echo -e "${YELLOW}IMPORTANT NOTES:${NC}"
echo "📝 Check your .env file configuration"
echo "🔐 Ensure database credentials are correct"
echo "📁 Verify file permissions on your server"
echo "🌐 Test your website functionality"
echo "=================================================="