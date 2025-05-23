<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdWelcomeController extends Controller
{
    // Tampilkan daftar card dengan pagination dan pencarian
    public function index(Request $request)
    {
        $query = Card::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('text', 'like', '%' . $request->search . '%');
            });
        }

       $cards = Card::orderBy('position')->paginate(10);


        return view('ad_profile.adwelcome', compact('cards'));
    }

    // Tampilkan form tambah card baru
public function create(Request $request)
{
    $afterId = $request->query('after');
    return view('ad_profile.newcard', compact('afterId'));
}


    public function store(Request $request)
{
$validated = $request->validate([
    'title' => 'required|string',
    'text' => 'required|string',
    'layout' => 'required|in:text-left,text-right,text-only,image-only',
    'text_align' => 'required|in:left,center,right,justify',
    'image' => 'nullable|image|max:1024',
    'after_id' => 'nullable|integer|exists:cards,id', // opsional untuk posisi
]);


    $afterId = $request->input('after_id');
    $position = 0;

    if ($afterId) {
        $afterCard = Card::find($afterId);
        if ($afterCard) {
            $position = $afterCard->position + 1;
            // Geser posisi card lain
            Card::where('position', '>=', $position)->increment('position');
        }
    } else {
        // Kalau tidak ada afterId, bisa letakkan paling bawah
        $maxPosition = Card::max('position');
        $position = $maxPosition ? $maxPosition + 1 : 1;
    }

    $validated['position'] = $position;

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('images', 'public');
    }

    Card::create($validated);

    return redirect()->route('adwelcome.index')->with('success', 'Card berhasil ditambahkan!');
}


    // Tampilkan form edit card
    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('ad_profile.newcard', compact('card'));
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
            'text_align' => 'required|in:left,center,right,justify',

        ]);

        // Upload gambar baru jika ada, dan hapus gambar lama jika ada
        if ($request->hasFile('image')) {
            if ($card->image && Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak upload gambar baru, biarkan path gambar lama tetap
            $validated['image'] = $card->image;
        }

        $card->update($validated);

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil diperbarui!');
    }

    // Hapus card beserta gambar terkait
    public function destroy($id)
    {
        $card = Card::findOrFail($id);

        // Hapus file gambar jika ada
        if ($card->image && Storage::disk('public')->exists($card->image)) {
            Storage::disk('public')->delete($card->image);
        }

        $card->delete();

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil dihapus!');
    }
}
