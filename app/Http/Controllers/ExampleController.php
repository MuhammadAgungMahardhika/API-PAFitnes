<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function fitnes(){
      $results = app('db')->select("SELECT * FROM fitnes"); 
    return response()->json($results);
    }
    
    public function bookFitnes(Request $request){
      
        $id_fitnes = $request->input('id_fitnes');
        $id_user = $request->input('id_user');
        $tanggal_booking = $request->input('tanggal_booking');
        
        $result = app('db')->insert("INSERT INTO detail_booking (id_fitnes,id_user,tanggal_booking)
        VALUES ($id_fitnes,'$id_user','$tanggal_booking')");
        
         $input = $request->all();
    
        return response()->json($input);
    }
    
      public function getClass(Request $request){
               $id_user = $request->input('id_user');

      $results = app('db')->select("SELECT id_booking,id_fitnes,id_user,tanggal_booking,nama_fitnes,alamat_fitnes,harga_perbulan FROM detail_booking 
      JOIN fitnes on detail_booking.id_fitnes = fitnes.id 
        WHERE id_user = '$id_user' ORDER BY id_booking DESC"); 
          
    return response()->json($results);
    }
    
    public function saveNotif(Request $request){
      
        $title = $request->input('title');
        $message = $request->input('message');
        $date = $request->input('date');
        $id_user = $request->input('id_user');
        
        $result = app('db')->insert("INSERT INTO detail_notif (title,message,date,id_user)
        VALUES ('$title','$message','$date','$id_user')");
        
         $input = $request->all();
    
        return response()->json($input);
    }
    
     public function locationFitnes(){
      $results = app('db')->select("SELECT id_location,id_fitnes,nama_fitnes,alamat_fitnes,jam_buka,lat,lng 
FROM location_fitnes JOIN fitnes on location_fitnes.id_fitnes = fitnes.id
"); 
    return response()->json($results);
    }

    public function search(Request $request){
      
        $query = $request->input('query');
    
        $result = app('db')->select("SELECT * FROM fitnes 
WHERE nama_fitnes LIKE '%$query%' ORDER BY nama_fitnes ASC");
      
    
        return response()->json($result);
    }
        
    public function notif(Request $request){
         $title = $request->input('title');
        $body = $request->input('body');
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "to":"/topics/Update"
            "notification":{
            "title": "+'$title'+",
            "body": "+'$body'+"
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
}
