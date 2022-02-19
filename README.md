# Fake Todo

## Installation
Clone the repository
```
git clone git@github.com:ahmard/fake-todo.git
```

Install composer packages
```
cd fake-todo
composer update
```

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
