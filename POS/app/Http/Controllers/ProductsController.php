<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function food(){
        return view('products.fnb');
    }
    public function beauty(){
        return view('products.bhealth');
    }
    public function home(){
        return view('products.hcare');
    }
    public function baby(){
        return view('products.bkid');
    }
}
