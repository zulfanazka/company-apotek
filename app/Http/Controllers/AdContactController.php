<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class AdContactController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('name')->get();
        return view('ad_company.adcontact.index', compact('locations'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();  // Mengambil semua lokasi
    return view('locations.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Location::create($request->all());

        return redirect()->route('adcontact.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

public function edit($id)
{
    $location = Location::findOrFail($id);
    return view('locations.edit', compact('location'));  // Pastikan view menerima $location
}


    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location->update($request->all());

        return redirect()->route('adcontact.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('adcontact.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}