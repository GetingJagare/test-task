## Code Style Testing
Go to app directory
```
cd app
```
Run this command only for code style test & fix
```
composer run-script cs-test
```

## Run the app in development mode
Go to app directory
```
cd app
```
If there is no .env file in the root app directory execute this commands
```
cp .env.example .env
php artisan key:generate
```
Check if these environment are set in .env file:
```
LOG_CHANNEL=stdout
```
```
DB_CONNECTION=mysql
DB_HOST=mysql 
DB_PORT=3306
DB_DATABASE=<db_name>
DB_USERNAME=<db_user>
DB_PASSWORD=<db_password>
```
```
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```
```
MAIL_MAILER=smtp
MAIL_HOST=maildev
MAIL_PORT=1025
```
```
ADMIN_NAME=admin
ADMIN_EMAIL=<admin_email>
ADMIN_PASSWORD=<admin_password>
```
After that go to parent directory and run the app via docker command
```
cd ..
docker compose up
```
