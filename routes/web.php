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

//menampilkan notifikasi
$router->post('/notif','ExampleController@notif');

//menampilkan search
$router->post('/search','ExampleController@search');

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
    
    $input = $request->all();
    
  
    return response()->json($input);
});

//menambah booking
$router->post('/bookFitnes','ExampleController@bookFitnes');

//mengambil data kelas
$router->post('/getClass','ExampleController@getClass');


$router->post('/register', 'UserController@register');
$router->post('/login','AuthController@login');


$router->group(['middleware' => 'auth'], function() use ($router){
    $router->post('/logout', 'AuthController@logout');
});
