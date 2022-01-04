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

//menampilkan data fitnes
$router->get('/data','ExampleController@fitnes');


//menambah data fitnes
$router->post('/postFitnes', function (Illuminate\Http\Request $request){
         $id = $request->input('id');
        $nama_fitnes = $request->input('nama_fitnes');
        $alamat_fitnes = $request->input('nama_fitnes');
        $fasilitas = $request->input('fasilitas');
        $harga_perbulan = $request->input('harga_perbulan');
        $no_fitnes = $request->input('no_fitnes');
        $jam_buka = $request->input('jam_buka');
        $gambar_fitnes = $request->input('gambar_fitnes');
    
        $result = DB::insert("INSERT INTO fitnes (id,nama_fitnes,alamat_fitnes,fasilitas,
        harga_perbulan,no_fitnes,jam_buka,gambar_fitnes)
        VALUES ($id,'$nama_fitnes','$alamat_fitnes','$fasilitas','$harga_perbulan','$no_fitnes','$jam_buka','$gambar_fitnes')");
  
    return ($result)? "wow":"Noo";
});

//menambah booking
$router->post('/bookFitnes','ExampleController@bookFitnes');

//menambah booking
$router->post('/book', function (Illuminate\Http\Request $request) {
       
        $id_fitnes = $request->input('id_fitnes');
        $id_user = $request->input('id_user');
    
        $result = DB::insert("INSERT INTO detail_booking (id_fitnes,id_user)
        VALUES ($id_fitnes,$id_user)");
    
       
        return ($result)? "wow":"Noo";
    });



$router->post('/register', 'UserController@register');
$router->post('/login','AuthController@login');


$router->group(['middleware' => 'auth'], function() use ($router){
    $router->post('/logout', 'AuthController@logout');
});
