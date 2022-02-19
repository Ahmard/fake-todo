# Fake Todo

## Installation
Clone the repository

Please note that this project requires **PHP 8.1**
```
git clone git@github.com:ahmard/fake-todo.git
```

Install composer packages
```
cd fake-todo
composer update
```

## Configuration
Edit [.env](.env) file to provide database & other configurable information

## Database
```
php artisan migrate --seed
```

## Running
```
php -S localhost:8000 -t public
```

## Endpoints
Please take a look at [requests.http](requests.http) for sample
