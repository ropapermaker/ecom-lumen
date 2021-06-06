# Lumen API for ecommerce

## Installation
`composer install` to setup the project  
`composer update` to update modules  
`php-mongodb` driver is needed to connect to the mongodb database  

## Setting the environment
Copy `.env.example` to `.env` in the project root and edit database credentials  
`php artisan jwt:secret` to generate JWT secret key  
`php artisan migrate` to setup a fresh MYSQL database  

## Starting the server
`php artisan serve` to start server  
