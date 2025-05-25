<?php

namespace App\Http\Controllers;

use App\Models\Card; // Model untuk adwelcome
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdWelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Card::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('text', 'like', '%' . $request->search . '%');
            });
        }

        $cards = $query->orderBy('position')->paginate(10);

        return view('ad_company.adwelcome.index', compact('cards'));
    }

    public function create(Request $request)
    {
        $afterId = $request->query('after');
        $routePrefix = 'adwelcome'; // Untuk shared view agar route dinamis
        return view('ad_company.shared.newcard', compact('afterId', 'routePrefix'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'text_align' => 'required|in:left,center,right,justify',
            'image' => 'nullable|image|max:1024',
            'after_id' => 'nullable|integer|exists:cards,id',
            'fit_mode' => 'required|in:cover,contain,original',
        ]);

        $afterId = $request->input('after_id');
        $position = 0;

        if ($afterId) {
            $afterCard = Card::find($afterId);
            if ($afterCard) {
                $position = $afterCard->position + 1;
                Card::where('position', '>=', $position)->increment('position');
            }
        } else {
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

    public function edit($id)
    {
        $card = Card::findOrFail($id);
        $routePrefix = 'adwelcome';
        return view('ad_company.shared.newcard', compact('card', 'routePrefix'));
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'image' => 'nullable|image|max:1024',
            'text_align' => 'required|in:left,center,right,justify',
            'fit_mode' => 'required|in:cover,contain,original',
        ]);

        if ($request->hasFile('image')) {
            if ($card->image && Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        } else {
            $validated['image'] = $card->image;
        }

        $card->update($validated);

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);

        if ($card->image && Storage::disk('public')->exists($card->image)) {
            Storage::disk('public')->delete($card->image);
        }

        $card->delete();

        return redirect()->route('adwelcome.index')->with('success', 'Card berhasil dihapus!');
    }
}
