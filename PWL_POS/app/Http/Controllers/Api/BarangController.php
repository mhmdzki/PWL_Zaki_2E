<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        return BarangModel::all();   
       }
       public function store(Request $request){
           $barang = BarangModel::create($request->all());
           return response()->json($barang,200);
       }
       public function show(BarangModel $barang){
           return $barang;
       }
       public function update(Request $request, BarangModel $barang){
   
           $barang->update($request->all());
           return $barang;
       }
       public function destroy(BarangModel $barang){
           $barang->delete();
   
           return response()->json([
               'success' => true,
               'message' => 'Data Terhapus',
           ]);
       }
}