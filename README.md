# Fake Todo
A fake todo api-based application

## Live Version
Visit [Fake Todo](https://ahmard-fake-todo.herokuapp.com/)

## Note
I added some custom routes such as **/todos/{id}/put** and **/todos/{id}/patch**
to help expose their respective functionality through **POST** method.
<br/>This happen because **jQuery** & **axios** converts **PATCH**, **PUT** and **DELETE** requests to **OPTIONS** which will return error response.

## Installation
Clone the repository

I've added some decorator to decorate the json response syntax.

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
