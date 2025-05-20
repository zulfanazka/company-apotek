<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdWelcomeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman landing / welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/adwelcome', function () {
    return view('ad_profile.adwelcome');
})->name('adwelcome');

// Login dan Authentication
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('loginaction', [LoginController::class, 'loginaction'])->name('loginaction');
Route::post('logoutaction', [LoginController::class, 'logoutaction'])->name('logoutaction')->middleware('auth');

// Main dashboard setelah login
Route::get('main', [MainController::class, 'index'])->name('main')->middleware('auth');

// Dashboard
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard');

// Inventory Routes
Route::prefix('inventory')->group(function () {
    Route::get('stokbarang', [InventoryController::class, 'stokBarang'])->name('stokbarang');
    Route::get('barangmasuk', [InventoryController::class, 'barangMasuk'])->name('barangmasuk');
    Route::get('barangkeluar', [InventoryController::class, 'barangKeluar'])->name('barangkeluar');

    // Form tambah/edit barang
    Route::get('tambahbarang', [InventoryController::class, 'tambahBarang'])->name('tambahbarang');
    Route::get('tambahbarangkeluar', [InventoryController::class, 'tambahBarangKeluar'])->name('tambahbarangkeluar');
    Route::get('editbarang/{id_barang}', [InventoryController::class, 'editBarang'])->name('editbarang');
    Route::get('editbarangkeluar/{id_barang}', [InventoryController::class, 'editBarangKeluar'])->name('editbarangkeluar');

    // Simpan data barang (tambah/update)
    Route::post('simpanbarang', [InventoryController::class, 'simpanBarang'])->name('simpanbarang');
    Route::post('simpanbarangkeluar', [InventoryController::class, 'simpanBarangKeluar'])->name('simpanbarangkeluar');

    // Hapus barang
    Route::delete('{id}', [InventoryController::class, 'delete'])->name('deletebarang');
    Route::delete('barangkeluar/{id_barang}', [InventoryController::class, 'deleteBarangKeluar'])->name('deletebarangkeluar');
    Route::delete('stokbarang/{id_barang}', [InventoryController::class, 'deleteStokBarang'])->name('deletestokbarang');

    Route::post('/update-barang', [InventoryController::class, 'updateBarang'])->name('updateBarang');

    // Laporan dan Export
    Route::get('laporan', [InventoryController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/export/{format}', [InventoryController::class, 'export'])->name('laporan.export');
});

// Profile
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');

// Product
Route::get('/product', [ProductController::class, 'index'])->name('product');

// Contact & Locations (CRUD lokasi pakai ContactController)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/locations/create', [ContactController::class, 'create'])->name('locations.create');

Route::post('/locations', [ContactController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}/edit', [ContactController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [ContactController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [ContactController::class, 'destroy'])->name('locations.destroy');

Route::get('/adwelcome', [AdWelcomeController::class, 'index'])->name('adwelcome');
Route::post('/adwelcome', [AdWelcomeController::class, 'store'])->name('adwelcome.store');
Route::get('/adwelcome/edit/{id}', [AdWelcomeController::class, 'edit'])->name('adwelcome.edit');
Route::put('/adwelcome/{id}', [AdWelcomeController::class, 'update'])->name('adwelcome.update');
Route::delete('/adwelcome/{id}', [AdWelcomeController::class, 'destroy'])->name('adwelcome.destroy');