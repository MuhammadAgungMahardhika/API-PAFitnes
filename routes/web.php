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
    return ["Hello Hai..!!!"];
});

$router->get('/data', function () use ($router) {
    
 
    $results = app('db')->select("SELECT * FROM fitnes");
    return response()->json($results);
});

$router->post('/post/id/nama_fitnes', function ($id,$nama_fitnes) use ($router) {
    

    $results_post = app('db')->insert("INSERT INTO fitnes (id, nama_fitnes)
VALUES ($id,'$nama_fitnes')");
    return response()->json($results_post);
});

$router->post('/register', 'UserController@register');
$router->post('/login','AuthController@login');


$router->group(['middleware' => 'auth'], function() use ($router){
    $router->post('/logout', 'AuthController@logout');
});
