## Code Style Testing 
Run this command only for code style test & fix
```
composer run-script cs-test
```

## Run the app in development mode
1. Run the app via docker command
```
docker compose up
```
2. Execute this command for applying database migrations
```
docker compose exec php sh /entrypoint.sh
```
## Run the app in production mode