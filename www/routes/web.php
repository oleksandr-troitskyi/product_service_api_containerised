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

$router->get('/', ['uses' => 'OpenAPIController@index']);
$router->get('/products', ['uses' => 'OpenAPIController@products']);
$router->post('/auth', ['uses' => 'AuthController@authenticate']);
$router->get('/user', ['uses' => 'APIController@user']);
$router->get('/user/products', ['uses' => 'APIController@getUserProducts']);
$router->post('/user/products', ['uses' => 'APIController@purchaseProduct']);
$router->delete('/user/products', ['uses' => 'APIController@deleteProductFromPurchased']);

