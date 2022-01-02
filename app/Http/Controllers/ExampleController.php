<?php

namespace App\Http\Controllers;

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

    //
}
