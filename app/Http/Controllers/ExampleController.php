<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{

    public function addFitnes(Illuminate\Http\Request $request){
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
    }
}
