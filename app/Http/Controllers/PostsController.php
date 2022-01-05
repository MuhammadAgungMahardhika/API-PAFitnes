<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(Request $request){
    $validator = Validator::make($request->all(), [
        'title'   => 'required',
        'content' => 'required',
    ]);

    if ($validator->fails()) {

        return response()->json([
            'success' => false,
            'message' => 'Semua Kolom Wajib Diisi!',
            'data'   => $validator->errors()
        ],401);

    } else {

        $post = Post::create([
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
        ]);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'data' => $post
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 400);
        }

    }
}
}
