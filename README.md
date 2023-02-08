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
Check if these environment variables are set in .env file, specify credentials for connecting to database:
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
Visit http://127.0.0.1:9000 and create bucket named "avatars", access and secret MinIO keys, then set these variables to .env:
```
AWS_ACCESS_KEY_ID=<aws_access_key>
AWS_SECRET_ACCESS_KEY=<aws_secret_key>
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=avatars
AWS_URL=http://minio:9000
AWS_ENDPOINT=http://minio:9000
AWS_USE_PATH_STYLE_ENDPOINT=true
```
After that go to parent directory and run the app via docker command
```
cd ..
docker compose up
```
Execute this command for applying database migrations
```
docker exec -it users_php sh /entrypoint.sh
```
## Run the app in production mode