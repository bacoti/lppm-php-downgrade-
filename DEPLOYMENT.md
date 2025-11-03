# LPPM Website Deployment Guide

## 🚀 Deployment Options

### Option 1: Using Deployment Script (Recommended)

```bash
# Make script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh
```

### Option 2: Manual Deployment

```bash
# 1. Backup database
cp database/database.sqlite database/database.sqlite.backup

# 2. Pull changes
git pull origin main

# 3. Install dependencies
composer install --no-dev --optimize-autoloader

# 4. Run migrations
php artisan migrate --force

# 5. Safe seeding (production)
php artisan db:seed --class=SafeDatabaseSeeder --force

# 6. Clear & cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

## 🛡️ Conflict Prevention Features

### 1. **Safe Seeding**
- Uses `updateOrCreate()` instead of `create()`
- Handles duplicate NIDN gracefully
- Skips existing data in production

### 2. **Database Backup**
- Automatic backup before deployment
- Quick restore if migration fails

### 3. **Environment Detection**
- Different seeding strategy for production vs development
- Conservative approach in production

### 4. **Error Handling**
- Try-catch blocks for each operation
- Detailed error messages
- Rollback capability

## 🔧 Configuration for Production

### 1. **Environment Variables**
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 2. **Web Server Configuration**

#### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/lppm/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 🚨 Common Deployment Issues & Solutions

### Issue 1: Unique Constraint Violation
```bash
# Solution: Use safe seeder
php artisan db:seed --class=SafeDatabaseSeeder --force
```

### Issue 2: Permission Denied
```bash
# Solution: Set correct permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Issue 3: 500 Internal Server Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan config:clear
php artisan cache:clear
```

### Issue 4: Database Connection Error
```bash
# Check .env file
cat .env | grep DB_

# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

## 📋 Pre-Deployment Checklist

- [ ] Database backup created
- [ ] .env file configured correctly
- [ ] File permissions set properly
- [ ] Web server configuration updated
- [ ] SSL certificate installed (if HTTPS)
- [ ] Domain DNS pointing to server
- [ ] Firewall rules configured

## 🔄 Updating Existing Deployment

### For Code Updates:
```bash
./deploy.sh
```

### For Data Updates Only:
```bash
php artisan db:seed --class=SafeDatabaseSeeder --force
```

### For Emergency Rollback:
```bash
# Restore database backup
cp database/database.sqlite.backup.YYYYMMDD_HHMMSS database/database.sqlite

# Revert to previous commit
git reset --hard HEAD~1
```

## 📞 Support

If you encounter issues during deployment:

1. Check the Laravel logs: `storage/logs/laravel.log`
2. Verify server requirements: PHP 8.1+, SQLite/MySQL
3. Test locally first before deploying to production
4. Keep database backups before any major changes