<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location; // Tambahkan ini untuk mengakses tabel locations

class ContactController extends Controller
{
    // Tampilkan halaman gabungan company profile + map
    public function index()
    {
        $locations = Location::all(); // Ambil semua data lokasi dari tabel
        return view('contact', compact('locations')); // Ganti view jika kamu memakai nama lain
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Location::create($request->all());
        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location->update($request->all());
        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}
