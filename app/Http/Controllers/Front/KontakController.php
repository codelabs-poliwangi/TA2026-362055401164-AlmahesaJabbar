<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    public function index()
    {
        return view('front.kontak');
    }
}
