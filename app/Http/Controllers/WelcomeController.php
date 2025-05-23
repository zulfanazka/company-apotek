<?php

namespace App\Http\Controllers;

use App\Models\Card;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $cards = Card::orderBy('position')->get();
        return view('welcome', compact('cards'));
    }
}
