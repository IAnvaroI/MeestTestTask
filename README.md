## Application start
To start application run these commands in provided order in project directory
```
cp .env.example .env
```
```
sudo docker compose build app
```
```
sudo docker compose up -d
```
```
sudo docker compose exec app composer install
```
```
sudo docker compose exec app php artisan key:generate
```
```
sudo docker compose exec app php artisan migrate
```
```
sudo docker compose exec app php artisan passport:install
```
## Setup connection to database from PhpStorm
1. Add MySQL data source in database menu 
2. In properties of database enter such data:
- Host: ```localhost```
- Port: ```3306```
- User: ```meesttesttask_user```
- Password: ```password```
- Database: ```meesttesttask```

