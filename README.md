Cara Konfigurasi Laravel :

**Note** : sebelum melakukan konfigurasi, pastikan anda telah download dan install XAMPP atau Laragon yang dapat support PHP versi 8 keatas supaya aplikasi laravel dapat berjalan

1. copy dan paste file .env.example di dalam folder app, lalu rename file tersebut menjadi .env (isi file .env akan diberikan di nomor 4)

2. untuk Collection API dan Database ada di dalam foler "Collection API dan DB"

3. Database yang saya upload adalah MySQL, anda bisa melakukan import dengan pilihan DB MySQL

4. Berikut konfigurasi file .env untuk dimasukkan/ditimpa kedalam file .env :

```html
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:KkkoSUEHOorp58DQZ/Isx2FtfPvb8PqFgBODeLeW+wc=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_yazid_marketingpenjualan
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

5. Setelah konfigurasi Database dan .env selesai, jalankan "php artisan serve" di terminal/CMD path project laravelnya, jika berhasil dijalankan maka akan muncul endpoint dengan port 8000 :
http://127.0.0.1:8000

6. Endpoint pada nomor 5, digunakan untuk HIT API dengan endpoint untuk Postman, sebagai berikut :
http://127.0.0.1:8000/api/routenya
