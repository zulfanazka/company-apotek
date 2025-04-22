<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product'); // atau view apa pun yang kamu mau tampilkan
    }
}
