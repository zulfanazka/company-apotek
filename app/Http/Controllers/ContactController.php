<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class ContactController extends Controller
{
    // Menampilkan halaman contact dengan peta dan data lokasi
    public function index()
    {
        $locations = Location::all();
        return view('contact', compact('locations'));
    }

    // Form tambah lokasi (opsional, tidak dipakai langsung dalam blade contact)
    public function create()
    {
        $locations = Location::all();  // Ambil data lokasi semua
        return view('locations.create', compact('locations')); // Kirim ke view
    }

    // Menyimpan data lokasi baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Location::create($request->all());
        return redirect()->route('contact')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    // Menampilkan form edit lokasi
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // Menyimpan pembaruan data lokasi
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location->update($request->all());
        return redirect()->route('contact')->with('success', 'Lokasi berhasil diperbarui.');
    }

    // Menghapus data lokasi
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('contact')->with('success', 'Lokasi berhasil dihapus.');
    }
}
