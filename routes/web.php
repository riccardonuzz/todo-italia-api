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


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group([
    'prefix' => 'auth'
], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/logout', 'AuthController@logout');
    $router->post('/refresh', 'AuthController@refresh');
    $router->get('/me', 'AuthController@me');

});

$router->post('/register', 'RegisterController@store');


// Todos routes
$router->get('/todos', 'TodosController@index');
$router->get('/todos/{id}', 'TodosController@show');


// Categories routes
// Can also set up middleware from router
$router->get('/categories', [
    'middleware' => 'auth:api',
    'uses' => 'CategoriesController@index'
]);


$router->get('/categories/{id}', [
    'middleware' => 'auth:api',
    'uses' => 'CategoriesController@show'
]);