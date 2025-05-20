<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class AdWelcomeController extends Controller
{
    // Menampilkan halaman dengan card yang ada
    public function index()
    {
        $cards = Card::all(); // Ambil semua card
        return view('ad_profile.adwelcome', compact('cards'));
    }

    // Menambah card baru
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'text' => 'required|string',
        'layout' => 'required|in:text-left,text-right,text-only,image-only',
        'image' => 'nullable|image|max:1024',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('images');
        $imageUrl = asset('storage/' . $validated['image']);
    } else {
        $imageUrl = null;
    }

    $card = Card::create($validated);

    return response()->json([
        'id' => $card->id,
        'title' => $card->title,
        'text' => $card->text,
        'layout' => $card->layout,
        'image_url' => $imageUrl,
    ]);
}


    // Edit card
    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return response()->json($card);
    }

    // Update card
    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images');
        }

        $card->update($validated);

        return redirect()->route('adwelcome');
    }

    // Hapus card
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->route('adwelcome');
    }
}
