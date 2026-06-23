# Deployment Guide

## Prerequisites
- PHP 8.4+
- MySQL 8 / MariaDB
- Redis
- Composer
- Node.js 20+
- npm / yarn
- Supervisor
- Nginx / Apache

## Steps

### 1. Clone Repository
```bash
git clone https://github.com/yourcompany/industrial-machinery-erp.git
cd industrial-machinery-erp
```

### 2. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev --no-interaction --no-progress
npm ci
npm run build
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your production values:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://perusahaan.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=industrial_machinery
DB_USERNAME=ims_user
DB_PASSWORD=your_secure_password

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY=your_meili_key

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null

SCOUT_DRIVER=meilisearch
```

### 4. Database Setup
```bash
php artisan migrate --seed
php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=RoleSeeder
```

### 5. Storage & Optimization
```bash
php artisan storage:link
php artisan optimize
php artisan event:cache
php artisan view:cache
php artisan route:cache
php artisan config:cache
```

### 6. Search Engine (Meilisearch)
```bash
php artisan scout:import "App\Models\Product"
php artisan scout:import "App\Models\Article"
php artisan scout:import "App\Models\Category"
```

### 7. Queue & Horizon
```bash
php artisan horizon:install
php artisan horizon:publish
```

### 8. Cron Job Setup
Add to crontab:
```cron
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

### 9. Supervisor Configuration
Create `/etc/supervisor/conf.d/ims.conf`:
```ini
[program:horizon]
command=php /path-to-project/artisan horizon
user=www-data
autostart=true
autorestart=true
startretries=3
stderr_logfile=/var/log/supervisor/horizon.err.log
stdout_logfile=/var/log/supervisor/horizon.out.log

[program:queue-worker]
command=php /path-to-project/artisan queue:work redis --sleep=3 --tries=3
user=www-data
autostart=true
autorestart=true
numprocs=2
process_name=%(program_name)s_%(process_num)02d

[program:scheduler]
command=php /path-to-project/artisan schedule:work
user=www-data
autostart=true
autorestart=true
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```

### 10. Nginx Configuration
```nginx
server {
    listen 80;
    server_name perusahaan.com;
    root /var/www/industrial-machinery-erp/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~ ^/(storage|uploads)/ {
        expires max;
        add_header Cache-Control "public, immutable";
    }
}
```

### 11. Docker Deployment (Alternative)
```bash
docker-compose -f docker/docker-compose.yml up -d
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| APP_NAME | Application name | Laravel |
| APP_ENV | Application environment | production |
| APP_DEBUG | Debug mode | false |
| APP_URL | Application URL | https://perusahaan.com |
| DB_CONNECTION | Database driver | mysql |
| DB_HOST | Database host | 127.0.0.1 |
| DB_PORT | Database port | 3306 |
| DB_DATABASE | Database name | industrial_machinery |
| DB_USERNAME | Database username | ims_user |
| DB_PASSWORD | Database password | - |
| REDIS_HOST | Redis host | 127.0.0.1 |
| REDIS_PORT | Redis port | 6379 |
| REDIS_PASSWORD | Redis password | null |
| MEILISEARCH_HOST | Meilisearch host | http://127.0.0.1:7700 |
| MEILISEARCH_KEY | Meilisearch key | - |
| MAIL_MAILER | Mail driver | smtp |
| MAIL_HOST | SMTP host | - |
| MAIL_PORT | SMTP port | 587 |
| MAIL_USERNAME | SMTP username | - |
| MAIL_PASSWORD | SMTP password | - |
| MAIL_FROM_ADDRESS | From address | noreply@perusahaan.com |
| MAIL_FROM_NAME | From name | PT Indo Industrial Machinery |
| GOOGLE_ANALYTICS_ID | Google Analytics ID | - |
| META_PIXEL_ID | Meta Pixel ID | - |
| COMPANY_NAME | Company name | PT Indo Industrial Machinery |
| COMPANY_EMAIL | Company email | info@perusahaan.com |
| COMPANY_PHONE | Company phone | (021) 1234-5678 |
| COMPANY_WHATSAPP | WhatsApp number | 6281234567890 |
| FILESYSTEM_DISK | Filesystem disk | local |
| QUEUE_CONNECTION | Queue driver | redis |
| CACHE_STORE | Cache store | redis |
| SESSION_DRIVER | Session driver | redis |
| BROADCAST_CONNECTION | Broadcast driver | log |

## Post-Deployment Checklist
- [ ] SSL Certificate installed (Let's Encrypt)
- [ ] `.env` APP_DEBUG set to false
- [ ] Storage link created
- [ ] Cache cleared and optimized
- [ ] Queue workers running
- [ ] Cron job configured
- [ ] Backup strategy in place
- [ ] Monitoring configured (Laravel Pulse / Sentry)
