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
        WHERE id_user = '$id_user' ORDER BY nama_fitnes ASC"); 
          
    return response()->json($results);
    }

    public function search(Request $request){
      
        $query = $request->input('query');
    
        $result = app('db')->select("SELECT * FROM fitnes 
WHERE nama_fitnes LIKE '%$query%' ORDER BY nama_fitnes ASC");
      
    
        return response()->json($result);
    }
        
    public function notif(){
 
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
}
