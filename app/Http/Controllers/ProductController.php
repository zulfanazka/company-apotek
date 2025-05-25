<?php

namespace App\Http\Controllers;

use App\Models\CardProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $cards = CardProduct::orderBy('position')->get();

        return view('product', compact('cards'));
    }
}

