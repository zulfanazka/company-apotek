<?php
namespace App\Http\Controllers;

use App\Models\Inventory;

class LihatBarangController extends Controller
{
    public function lihatbarang()
    {
        $barang = Inventory::all(); // Ambil data dari model Inventory (database mysql2)
        return view('lihatbarang', compact('barang'));
    }
}
