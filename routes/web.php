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
$router->get('/data', function () use ($router) {

    $results = app('db')->select("SELECT * FROM fitnes");
    return response()->json($results);
});

//menambah data fitnes
$router->post('/postFitnes', function (Illuminate\Http\Request $request) {
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
     if($result){
         notif();
     
     }   
    
    return ($result)? "wow":"Noo";
    });
public function notif(){
 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pafitnes.herokuapp.com/data',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>'{
    "to":"fBElW_ghTvyjShkwd7F_ao:APA91bH1qgpIpus2O-6WNfL10EXQesd3zhlddw6x0jc58IhDqeJULwPMG9BUWE-ChtI_MeByyxTccMyt-7KbeglQvzHhak4tRk9E6p2h_bzIylgSdk7otzyziblhdsEVz8jmkNMtYXEL"
    "notification":{
    "title": "Succes booking class",
    "body": "You have succesfull booking the class"
    }
   
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: key=AAAAvCm4eeo:APA91bEYAW38FdnuzDrDLmr1uisn2cupenc4JPPErX-Nc15Y3eqtFO5BXKV5vtWVGTWncYfr4xtpzyschaRlZvrvaIRAMzSy-flmfof_QjEJ7yL6D1Wj0NdE6C4tn9jIEyVDj4un95vE',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);   
}

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
