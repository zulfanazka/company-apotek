<?php

namespace App\Http\Controllers;

use App\Models\CardProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $cards = CardProfile::orderBy('position')->get();

        return view('profiles', compact('cards'));
    }
}
