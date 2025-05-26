<?php

namespace App\Http\Controllers;

use App\Models\CardProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdProductController extends Controller
{
    public function index(Request $request)
    {
        $query = CardProduct::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('text', 'like', '%' . $request->search . '%');
        }

        $cards = $query->orderBy('position')->paginate(10);

        return view('ad_company.adproduct.index', compact('cards'));
    }

    public function create(Request $request)
    {
        $afterId = $request->query('after');
        $routePrefix = 'adproduct'; // Untuk blade form agar route dinamis
        return view('ad_company.shared.newcard', compact('afterId', 'routePrefix'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'text_align' => 'required|in:left,center,right,justify',
            'image' => 'nullable|image|max:3072',
            'after_id' => 'nullable|integer|exists:card_product,id',
            'fit_mode' => 'required|in:cover,contain,original',
        ]);

        $afterId = $request->input('after_id');
        $position = 0;

        if ($afterId) {
            $afterCard = CardProduct::find($afterId);
            if ($afterCard) {
                $position = $afterCard->position + 1;
                CardProduct::where('position', '>=', $position)->increment('position');
            }
        } else {
            $maxPosition = CardProduct::max('position');
            $position = $maxPosition ? $maxPosition + 1 : 1;
        }

        $validated['position'] = $position;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        CardProduct::create($validated);

        return redirect()->route('adproduct.index')->with('success', 'Card berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $card = CardProduct::findOrFail($id);
        $routePrefix = 'adproduct';
        return view('ad_company.shared.newcard', compact('card', 'routePrefix'));
    }

    public function update(Request $request, $id)
    {
        $card = CardProduct::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'layout' => 'required|in:text-left,text-right,text-only,image-only',
            'image' => 'nullable|image|max:3072',
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

        return redirect()->route('adproduct.index')->with('success', 'Card berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $card = CardProduct::findOrFail($id);

        if ($card->image && Storage::disk('public')->exists($card->image)) {
            Storage::disk('public')->delete($card->image);
        }

        $card->delete();

        return redirect()->route('adproduct.index')->with('success', 'Card berhasil dihapus!');
    }
}
