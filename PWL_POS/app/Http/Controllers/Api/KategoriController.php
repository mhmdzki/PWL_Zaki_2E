<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        return KategoriModel::all();   
       }
       public function store(Request $request){
           $kategori = KategoriModel::create($request->all());
           return response()->json($kategori,200);
       }
       public function show(KategoriModel $kategori){
           return $kategori;
       }
       public function update(Request $request, KategoriModel $kategori){
   
           $kategori->update($request->all());
           return $kategori;
       }
       public function destroy(KategoriModel $kategori){
           $kategori->delete();
   
           return response()->json([
               'success' => true,
               'message' => 'Data Terhapus',
           ]);
       }
}