<?php

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
$router->post('auth/login','Auth@authenticate');

$router->group(
    ['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->get('/kategori', 'KategoriController@index');
        $router->get('/kategori/{id}', 'KategoriController@show');
        $router->post('/kategori', 'KategoriController@store');
        $router->put('/kategori/{id}', 'KategoriController@update');
        $router->delete('/kategori/{id}', 'KategoriController@destroy');
    }
);