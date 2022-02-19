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

use App\Http\Controllers\PostController;

$router->get('/', function () use ($router) {
    return \App\Http\JsonResponse::success(['message' => 'Hello World']);
});

$router->get('/posts', 'PostController@list');
$router->post('/posts', 'PostController@create');
$router->get('/posts/{id}', 'PostController@find');
$router->get('/posts/{id}/comments', 'PostController@postComments');
$router->put('/posts/{id}', 'PostController@update');
$router->patch('/posts/{id}', 'PostController@patch');
$router->delete('/posts/{id}', 'PostController@delete');
