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
1. Go to app directory
```
cd app
```
2. If there is no .env file in the root app directory execute this commands
```
cp .env.example .env
php artisan key:generate
```
* Check if these environment variables are set in .env file:
```
LOG_CHANNEL=stdout
```
* Specify credentials for connecting to database
```
DB_DATABASE=<db_name>
DB_USERNAME=<db_user>
DB_PASSWORD=<db_password>
```
* Admin info
```
ADMIN_NAME=<admin_name>
ADMIN_EMAIL=<admin_email>
ADMIN_PASSWORD=<admin_password>
```
* Visit http://127.0.0.1:9000 and create access and secret MinIO keys:
```
AWS_ACCESS_KEY_ID=<aws_access_key>
AWS_SECRET_ACCESS_KEY=<aws_secret_key>
```
3. After that go to parent directory and run the app via docker command
```
cd ..
docker compose up
```
4. Execute this command for applying database migrations
```
docker exec -it users_php sh /entrypoint.sh
```
## Run the app in production mode