# Lumen API for ecommerce

## Installation
`composer install` to setup the project
`composer update` to update modules
`php-mongodb` driver is needed to connect to mongodb database

## Setting the environment
Copy `.env.example` to `.env` and edit database varables the project root
`php artisan jwt:secret` to generate JWT secret key
`php artisan migrate` to setup a fresh database

## Starting the server
`php artisan serve` to start server
