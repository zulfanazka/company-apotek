<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class ContactController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('contact', compact('locations'));
    }
}
