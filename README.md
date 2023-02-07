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
Check if these environment variables are set in .env file:
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
AWS_ACCESS_KEY_ID=<aws_access_key>
AWS_SECRET_ACCESS_KEY=<aws_secret_key>
AWS_DEFAULT_REGION=<aws_region>
AWS_BUCKET=<aws_bucket_name>
AWS_URL=http://minio:<aws_port>
AWS_ENDPOINT=http://minio:<aws_port>
AWS_USE_PATH_STYLE_ENDPOINT=true
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
