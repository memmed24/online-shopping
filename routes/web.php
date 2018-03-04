<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|$router->get('user[/{name}]', function($name=null){
//     echo "ads";
//     echo $name;
// });
*/
use Illuminate\Http\Response;

$router->get('/', function () use ($router) {
    echo "Hello world";
});

$router->post('/user/create', 'UserController@create');
$router->post('/login', 'UserController@login');
$router->post('/logout',['middleware' => 'auth', 'uses' => 'UserController@logout']);
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@get']);
$router->post('/user/update', ['middleware' => 'auth', 'uses' => 'UserController@update']);

$router->get('/warehouse', 'WarehouseController@getWarehouse');
$router->post('/warehouse/create', ['middleware' => 'auth', 'uses' => 'WarehouseController@create']);
$router->post('/warehouse/update', ['middleware' => 'auth', 'uses' => 'WarehouseController@update']);
$router->get('/warehouse/{id}', 'WarehouseController@get');

$router->get('/orders', ['middleware' => 'auth', 'uses' => 'UserController@orders']);
$router->get('/order/{id}',['middleware' => 'auth', 'uses' => 'UserController@makeOrder']);
$router->get('/order/cancel/{id}',['middleware' => 'auth', 'uses' => 'UserController@cancelOrder']);