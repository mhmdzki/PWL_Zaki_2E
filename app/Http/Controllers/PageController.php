<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'SELAMAT DATANG';
    }

    public function about() {
        return 'Zaki 2341720052';
    }

    public function articles($id) {
        return 'Halaman Artikel '.$id;
    }
}
