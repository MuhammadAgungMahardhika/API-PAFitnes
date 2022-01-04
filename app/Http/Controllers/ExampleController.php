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
        
        if($results){
            $this->notif();
            
        }
    return response()->json($results);
    }
    
    public function bookFitnes(Request $request){
       
        $id_fitnes = $request->input('id_fitnes');
        $id_user = $request->input('id_user');
    
        $result = DB::insert("INSERT INTO detail_booking (id_fitnes,id_user)
        VALUES ($id_fitnes,$id_user)");
    
       
        return ($result)? "wow":"Noo";
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

    //
}
