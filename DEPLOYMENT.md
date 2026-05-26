# 🚀 Deployment Guide - Docker & Production

## Table of Contents
1. [Local Development Setup](#local-development-setup)
2. [Docker Architecture](#docker-architecture)
3. [Production Deployment](#production-deployment)
4. [Environment Configuration](#environment-configuration)
5. [Database Management](#database-management)
6. [Monitoring & Maintenance](#monitoring--maintenance)
7. [Troubleshooting](#troubleshooting)

---

## Local Development Setup

### Prerequisites
- Docker Desktop (or Docker Engine + Docker Compose)
- Git
- 4GB+ RAM available
- 2GB+ disk space

### Step 1: Clone Repository
```bash
git clone https://github.com/GaassXX/uts-2026.git
cd uts-2026
```

### Step 2: Copy Environment File
```bash
cd src
cp .env.example .env
cd ..
```

### Step 3: Start Docker Containers
```bash
docker-compose up -d
```

**What this does:**
- Starts PHP-FPM container (port 9000)
- Starts Nginx container (ports 80, 443)
- Starts MySQL/MariaDB container (port 3306)
- Creates shared networks between containers

### Step 4: Install Dependencies
```bash
# Install PHP dependencies
docker-compose exec php composer install

# Install Node dependencies
docker-compose exec php npm install

# Generate app key
docker-compose exec php php artisan key:generate
```

### Step 5: Setup Database
```bash
# Run migrations
docker-compose exec php php artisan migrate

# Optional: Seed database with sample data
docker-compose exec php php artisan db:seed
```

### Step 6: Build Frontend Assets
```bash
# Development (with hot reload)
docker-compose exec php npm run dev

# Or production build
docker-compose exec php npm run build
```

### Step 7: Access Application
- **Homepage**: https://uts.test
- **Admin Panel**: https://uts.test/admin
- **Default Credentials**: 
  - Email: `admin@uts.test`
  - Password: `password`

---

## Docker Architecture

### docker-compose.yml Structure

```yaml
version: '3.8'

services:
  # PHP-FPM Service (Application Server)
  php:
    build:
      context: ./php
      dockerfile: Dockerfile
    container_name: uts_php
    working_dir: /var/www
    environment:
      - APP_NAME=UTS Portfolio
      - APP_ENV=local
      - APP_DEBUG=true
    volumes:
      - ./src:/var/www
      - ./php/local.ini:/usr/local/etc/php/conf.d/local.ini
    networks:
      - uts_network
    depends_on:
      - db

  # Nginx Service (Web Server)
  nginx:
    build:
      context: ./nginx
      dockerfile: Dockerfile
    container_name: uts_nginx
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./src:/var/www
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
      - ./nginx/ssl:/etc/nginx/ssl
    networks:
      - uts_network
    depends_on:
      - php

  # MySQL/MariaDB Service (Database)
  db:
    image: mariadb:11
    container_name: uts_db
    environment:
      MYSQL_DATABASE: uts_db
      MYSQL_ROOT_PASSWORD: root
      MYSQL_ROOT_HOST: '%'
    volumes:
      - ./db/data:/var/lib/mysql
      - ./db/conf.d:/etc/mysql/conf.d
    ports:
      - "3306:3306"
    networks:
      - uts_network
    healthcheck:
      test: ["CMD", "healthcheck.sh", "--connect"]
      interval: 10s
      timeout: 5s
      retries: 5

networks:
  uts_network:
    driver: bridge
```

### Container Details

#### 1. PHP Container
- **Base Image**: PHP 8.2-FPM
- **Extensions**: PDO, MySQL, GD, Zip, JSON
- **Working Directory**: `/var/www`
- **Entry Point**: `docker-entrypoint.sh`
  - Installs Composer
  - Sets permissions
  - Starts FPM

**Dockerfile**:
```dockerfile
FROM php:8.2-fpm

# Install extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libgd-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql gd zip json

COPY ./local.ini /usr/local/etc/php/conf.d/
COPY ./docker-entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
```

#### 2. Nginx Container
- **Base Image**: Nginx:latest
- **Listens On**: Port 80 (HTTP), 443 (HTTPS)
- **Configuration**: `nginx/default.conf`
- **SSL Certificates**: `nginx/ssl/`

**Server Configuration** (`nginx/default.conf`):
```nginx
server {
    listen 80;
    server_name uts.test;
    
    root /var/www/public;
    index index.php index.html;
    
    # Redirect to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name uts.test;
    
    root /var/www/public;
    index index.php index.html;
    
    # SSL Certificates
    ssl_certificate /etc/nginx/ssl/uts.test.crt;
    ssl_certificate_key /etc/nginx/ssl/uts.test.key;
    
    # Pass PHP to FPM
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass php:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Public assets cache
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
    
    # Rewrite for Laravel
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

#### 3. MariaDB Container
- **Base Image**: MariaDB:11
- **Port**: 3306
- **Default Database**: `uts_db`
- **Root User**: `root`
- **Root Password**: `root`
- **Data Volume**: `./db/data/`

---

## Production Deployment

### Option 1: Deploy to VPS (Recommended for Learning)

#### Prerequisites
- VPS with Linux (Ubuntu 22.04 recommended)
- Domain name with DNS setup
- SSH access to server
- Docker & Docker Compose installed on VPS

#### Step 1: SSH to Server
```bash
ssh user@your-vps-ip
```

#### Step 2: Clone Repository
```bash
git clone https://github.com/GaassXX/uts-2026.git
cd uts-2026
```

#### Step 3: Setup SSL Certificates (Let's Encrypt)
```bash
# Install Certbot
sudo apt-get update
sudo apt-get install -y certbot python3-certbot-nginx

# Generate certificates
sudo certbot certonly --standalone -d your-domain.com -d www.your-domain.com

# Copy certificates to nginx/ssl/
mkdir -p nginx/ssl
sudo cp /etc/letsencrypt/live/your-domain.com/fullchain.pem nginx/ssl/cert.pem
sudo cp /etc/letsencrypt/live/your-domain.com/privkey.pem nginx/ssl/key.pem
sudo chown $USER:$USER nginx/ssl/*
```

#### Step 4: Update Configuration

**Update docker-compose.yml**:
```yaml
services:
  nginx:
    ports:
      - "80:80"
      - "443:443"
    environment:
      - DOMAIN=your-domain.com
```

**Update .env for production**:
```bash
cd src

# Edit .env
APP_NAME="UTS Portfolio"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_HOST=db
DB_DATABASE=uts_db
DB_USERNAME=root
DB_PASSWORD=YOUR_SECURE_PASSWORD

MAIL_FROM_NAME="UTS Portfolio"
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```

#### Step 5: Start Production Services
```bash
# Pull latest code
git pull origin main

# Rebuild images (if Dockerfile changed)
docker-compose build --no-cache

# Start services in background
docker-compose up -d

# Run migrations
docker-compose exec php php artisan migrate

# Clear caches
docker-compose exec php php artisan cache:clear
docker-compose exec php php artisan config:cache
docker-compose exec php php artisan route:cache

# Build frontend
docker-compose exec php npm run build
```

#### Step 6: Setup Backup Strategy
```bash
# Create backup script (backup.sh)
#!/bin/bash

BACKUP_DIR="/home/user/backups"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

# Backup database
docker-compose exec -T db mysqldump -uroot -proot uts_db | gzip > $BACKUP_DIR/db_$TIMESTAMP.sql.gz

# Backup application files
tar -czf $BACKUP_DIR/app_$TIMESTAMP.tar.gz ./src

# Upload to cloud (example: AWS S3, Google Drive, etc)
# aws s3 cp $BACKUP_DIR/db_$TIMESTAMP.sql.gz s3://your-bucket/

# Keep only last 7 days
find $BACKUP_DIR -type f -mtime +7 -delete
```

Run backup daily via crontab:
```bash
# Add to crontab
0 2 * * * /home/user/backup.sh
```

---

### Option 2: Deploy to Cloud Platforms

#### Heroku
```bash
# Install Heroku CLI
npm install -g heroku

# Login
heroku login

# Create app
heroku create your-app-name

# Add buildpacks
heroku buildpacks:add heroku/php
heroku buildpacks:add heroku/nodejs

# Add environment variables
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false

# Deploy
git push heroku main

# Run migrations
heroku run php artisan migrate
```

#### AWS (ECS + RDS)
```bash
# Requires AWS CLI configured

# Create ECR repository
aws ecr create-repository --repository-name uts-portfolio

# Build and push image
docker tag uts_php:latest <aws_account_id>.dkr.ecr.us-east-1.amazonaws.com/uts-portfolio:latest
docker push <aws_account_id>.dkr.ecr.us-east-1.amazonaws.com/uts-portfolio:latest

# Deploy via CloudFormation/Terraform (more complex setup)
```

#### DigitalOcean App Platform
```bash
# Connect GitHub repository
# Configure app.yaml
# Deploy via dashboard or CLI

doctl apps create --spec app.yaml
```

---

## Environment Configuration

### .env Variables for Different Environments

#### Development
```env
APP_ENV=local
APP_DEBUG=true
CACHE_DRIVER=array
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

#### Production
```env
APP_ENV=production
APP_DEBUG=false
CACHE_DRIVER=redis
SESSION_DRIVER=cookie
QUEUE_CONNECTION=database
```

### Critical Security Variables
```env
# Never commit these to git (use .env.example instead)
APP_KEY=base64:...         # Generate with: php artisan key:generate
DB_PASSWORD=secure_password
MAIL_PASSWORD=smtp_password
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
```

---

## Database Management

### Backup Database
```bash
# Local backup
docker-compose exec db mysqldump -uroot -proot uts_db > backup.sql

# Compressed backup
docker-compose exec db mysqldump -uroot -proot uts_db | gzip > backup.sql.gz
```

### Restore Database
```bash
# From backup
docker-compose exec -T db mysql -uroot -proot uts_db < backup.sql

# Or using gunzip
gunzip < backup.sql.gz | docker-compose exec -T db mysql -uroot -proot uts_db
```

### Access Database Console
```bash
# Via Docker
docker-compose exec db mysql -uroot -proot uts_db

# Via GUI tools (MySQL Workbench, DBeaver)
# Host: localhost:3306
# User: root
# Password: root
# Database: uts_db
```

---

## Monitoring & Maintenance

### Container Health Monitoring
```bash
# Check container status
docker-compose ps

# View container logs
docker-compose logs -f php
docker-compose logs -f nginx
docker-compose logs -f db

# Check container resource usage
docker stats
```

### Application Monitoring
```bash
# Clear application cache
docker-compose exec php php artisan cache:clear

# Clear configuration cache (must do after .env changes)
docker-compose exec php php artisan config:cache

# Clear route cache
docker-compose exec php php artisan route:cache

# View application logs
docker-compose exec php tail -f storage/logs/laravel.log
```

### Database Maintenance
```bash
# Optimize tables
docker-compose exec db mysql -uroot -proot uts_db -e "OPTIMIZE TABLE projects, profiles, contacts, users;"

# Check database integrity
docker-compose exec db mysql -uroot -proot uts_db -e "CHECK TABLE projects, profiles, contacts, users;"

# Analyze tables for query optimization
docker-compose exec db mysql -uroot -proot uts_db -e "ANALYZE TABLE projects, profiles, contacts, users;"
```

### SSL Certificate Renewal (Production)
```bash
# Certbot auto-renewal
sudo certbot renew --quiet --no-self-upgrade

# Or manual renewal
sudo certbot renew

# Restart Nginx
docker-compose exec nginx nginx -s reload
```

---

## Troubleshooting

### Container Won't Start

**Problem**: `docker-compose up` fails

```bash
# Check docker-compose syntax
docker-compose config

# View detailed error logs
docker-compose logs

# Try rebuild
docker-compose build --no-cache
docker-compose up -d
```

### Permission Denied Errors

**Problem**: Cannot write to storage/logs or storage/app

```bash
# Fix permissions from host
sudo chown -R $USER:$USER ./src/storage
chmod -R 755 ./src/storage

# Or from inside container
docker-compose exec php chmod -R 777 /var/www/storage
docker-compose exec php chmod -R 777 /var/www/bootstrap/cache
```

### Database Connection Error

**Problem**: `SQLSTATE[HY000]: General error: 2006 MySQL has gone away`

```bash
# Restart database container
docker-compose restart db

# Check if database is healthy
docker-compose ps db

# Verify credentials in .env
docker-compose exec php php artisan tinker
>>> DB::connection()->getPdo();
```

### Port Already in Use

**Problem**: `Address already in use`

```bash
# Change port in docker-compose.yml
# Or kill existing process
lsof -i :80
lsof -i :443
lsof -i :3306

# Kill specific process
kill -9 <PID>
```

### Slow Performance

**Problem**: Application running slow

```bash
# Clear caches
docker-compose exec php php artisan cache:clear
docker-compose exec php php artisan config:cache

# Optimize autoloader
docker-compose exec php composer dump-autoload -o

# Rebuild frontend
docker-compose exec php npm run build

# Check database performance
docker-compose exec db mysql -uroot -proot uts_db
> SHOW PROCESSLIST;
> EXPLAIN SELECT * FROM projects WHERE status='completed';
```

### SSL Certificate Issues

**Problem**: HTTPS not working

```bash
# Check certificate expiry
openssl x509 -in nginx/ssl/cert.pem -noout -dates

# Verify certificate chain
openssl verify -CAfile nginx/ssl/cert.pem nginx/ssl/cert.pem

# Test SSL configuration
docker-compose exec nginx nginx -t

# Regenerate self-signed certificate for local dev
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout nginx/ssl/uts.test.key \
  -out nginx/ssl/uts.test.crt \
  -subj "/CN=uts.test"
```

---

## Scaling Strategies (Future)

### Horizontal Scaling
```yaml
# Add PHP worker containers
  php-worker-1:
    extends: php
    container_name: uts_php_1
    
  php-worker-2:
    extends: php
    container_name: uts_php_2

# Load balance with Nginx
upstream php {
    server php:9000;
    server php_worker_1:9000;
    server php_worker_2:9000;
}
```

### Add Redis for Caching
```yaml
  redis:
    image: redis:latest
    ports:
      - "6379:6379"
    networks:
      - uts_network

# Update .env
CACHE_DRIVER=redis
REDIS_HOST=redis
```

### Add Message Queue
```yaml
  queue:
    image: uts_php
    command: php /var/www/artisan queue:listen
    networks:
      - uts_network
    depends_on:
      - db
```

---

## Checklists

### Pre-Production Checklist
- [ ] Update `.env` with production values
- [ ] Set `APP_DEBUG=false`
- [ ] Generate `APP_KEY` securely
- [ ] Setup SSL certificates
- [ ] Configure backup strategy
- [ ] Setup monitoring & alerts
- [ ] Test database migrations
- [ ] Run tests: `php artisan test`
- [ ] Build frontend assets: `npm run build`
- [ ] Setup CI/CD pipeline

### Regular Maintenance
- [ ] Daily: Check application logs
- [ ] Daily: Verify database backups
- [ ] Weekly: Review security logs
- [ ] Monthly: Update dependencies
- [ ] Monthly: Optimize database
- [ ] Quarterly: Security audit

---

**Last Updated**: May 26, 2026  
**Docker Version**: 20.10+  
**Docker Compose Version**: 2.0+
