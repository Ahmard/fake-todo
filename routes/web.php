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
    return view('index');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/todos', 'TodoController@list');
    $router->post('/todos', 'TodoController@create');
    $router->get('/todos/{id}', 'TodoController@find');

    $router->put('/todos/{id}', 'TodoController@update');
    $router->patch('/todos/{id}', 'TodoController@patch');
    $router->post('/todos/{id}/put', 'TodoController@patch');  // PUT request is not supported by axios
    $router->post('/todos/{id}/patch', 'TodoController@patch');

    $router->get('/todos/{id}/delete', 'TodoController@delete');
    $router->delete('/todos/{id}', 'TodoController@delete');
});
