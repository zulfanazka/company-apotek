<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

use App\Models\Inventory;

// Route Homepage / Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::get('/', [LoginController::class, 'login'])->name('login'); // ini duplikat sama di atas, pastikan mau pakai yang mana
Route::post('loginaction', [LoginController::class, 'loginaction'])->name('loginaction');
Route::post('logoutaction', [LoginController::class, 'logoutaction'])->name('logoutaction')->middleware('auth');

// Main
Route::get('main', [MainController::class, 'index'])->name('main')->middleware('auth');

// Dashboard
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard');

// Inventory Routes
Route::prefix('inventory')->group(function () {
    Route::get('stokbarang', [InventoryController::class, 'stokBarang'])->name('stokbarang');
    Route::get('barangmasuk', [InventoryController::class, 'barangMasuk'])->name('barangmasuk');
    Route::get('barangkeluar', [InventoryController::class, 'barangKeluar'])->name('barangkeluar');

    Route::get('tambahbarang', [InventoryController::class, 'tambahBarang'])->name('tambahbarang');
    Route::get('tambahbarangkeluar', [InventoryController::class, 'tambahBarangKeluar'])->name('tambahbarangkeluar');

    Route::get('editbarang/{id_barang}', [InventoryController::class, 'editBarang'])->name('editbarang');
    Route::get('editbarangkeluar/{id_barang}', [InventoryController::class, 'editBarangKeluar'])->name('editbarangkeluar');

    Route::post('simpanbarang', [InventoryController::class, 'simpanBarang'])->name('simpanbarang');
    Route::post('simpanbarangkeluar', [InventoryController::class, 'simpanBarangKeluar'])->name('simpanbarangkeluar');

    Route::delete('{id}', [InventoryController::class, 'delete'])->name('deletebarang');
    Route::delete('barangkeluar/{id_barang}', [InventoryController::class, 'deleteBarangKeluar'])->name('deletebarangkeluar');
    Route::delete('stokbarang/{id_barang}', [InventoryController::class, 'deleteStokBarang'])->name('deletestokbarang');

    Route::post('/update-barang', [InventoryController::class, 'updateBarang'])->name('updateBarang');

    Route::get('/laporan', [InventoryController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/export/{format}', [InventoryController::class, 'export'])->name('laporan.export');
});

// Profile Routes
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');

// Product Routes
Route::get('/product', [ProductController::class, 'index'])->name('product');

// Contact & Locations Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/locations/create', [ContactController::class, 'create'])->name('locations.create');
Route::post('/locations', [ContactController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}/edit', [ContactController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [ContactController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [ContactController::class, 'destroy'])->name('locations.destroy');
