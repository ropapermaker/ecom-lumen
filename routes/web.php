<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->group(['prefix'=>'user'], function() use ($router){
    $router->post('register', 'UserController@register');
    $router->post('login', 'UserController@login');
    $router->post('view-profile', 'UserController@viewProfile');
    $router->get('logout', 'UserController@logout');
    $router->post('refresh-token', 'UserController@refreshToken');
});

$router->group(['prefix'=>'admin'], function() use ($router){
    $router->post('register', 'AdminController@register');
    $router->post('login', 'AdminController@login');
    $router->post('view-profile', 'AdminController@viewProfile');
    $router->get('logout', 'AdminController@logout');
    $router->post('refresh-token', 'AdminController@refreshToken');
});

$router->group(['prefix'=>'seller'], function() use ($router){
    $router->post('register', 'SellerController@register');
    $router->post('login', 'SellerController@login');
    $router->post('view-profile', 'SellerController@viewProfile');
    $router->get('logout', 'SellerController@logout');
    $router->post('refresh-token', 'SellerController@refreshToken');
});