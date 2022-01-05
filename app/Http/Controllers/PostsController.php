<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public funtion index(){
     $posts = Post::OrderBy('id','DESC')->paginate(10);
        
        $output = [
        'message'=>'posts',
            'results' => $posts
        
        
        ];
        
        
    }
    
    public function store(Request $request){
    $input = $request->all();
    $posts = Post::create($input);
        
        return response()->json($post, 200);
    
    }
}
