<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class AdWelcomeController extends Controller
{
    // Menampilkan daftar card dengan pagination dan pencarian
    public function index(Request $request)
    {
        $query = Card::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('text', 'like', '%' . $request->search . '%');
            });
        }

        $cards = $query->orderBy('id')->paginate(10);

        return view('ad_profile.adwelcome', compact('cards'));
    }

    // Tampilkan form tambah card baru
    public function create()
    {
        return view('ad_profile.newcard');  // Pastikan blade ini sudah ada
    }

    // Simpan data card baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'image' => 'nullable|image|max:1024',  // max 1MB
        ]);

        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/images
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        Card::create($validated);

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil ditambahkan!');
    }

    // Tampilkan form edit card
    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('ad_profile.edit_card', compact('card')); // buat blade edit_card
    }

    // Update data card
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
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $card->update($validated);

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil diperbarui!');
    }

    // Hapus card
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil dihapus!');
    }
}
