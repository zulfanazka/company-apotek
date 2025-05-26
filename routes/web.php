<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\AdWelcomeController;
use App\Http\Controllers\AdProfileController;
use App\Http\Controllers\AdProductController;
use App\Http\Controllers\AdContactController;
use App\Http\Controllers\LihatBarangController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman landing / welcome (gunakan satu route saja)
Route::get('/', [WelcomeController::class, 'welcome'])->name('home'); // atau 'welcome', pilih salah satu

// Resource route untuk adwelcome, adprofile, dan adproduct
Route::resource('adwelcome', AdWelcomeController::class);
Route::resource('adprofile', AdProfileController::class);
Route::resource('adproduct', AdProductController::class);

// Main dashboard setelah login
Route::get('main', [MainController::class, 'index'])->name('main')->middleware('auth');

// Profile dan Product halaman front-end biasa
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');
Route::get('/product', [ProductController::class, 'index'])->name('product');

// Contact & Locations (CRUD lokasi pakai ContactController)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// CRUD lokasi menggunakan AdContactController via route manual
Route::get('/locations/create', [AdContactController::class, 'create'])->name('locations.create');
Route::post('/locations', [AdContactController::class, 'store'])->name('locations.store');
Route::get('locations/{location}/edit', [AdContactController::class, 'edit'])->name('locations.edit');
Route::put('locations/{location}', [AdContactController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [AdContactController::class, 'destroy'])->name('locations.destroy');

// Resource route untuk adcontact
Route::resource('adcontact', AdContactController::class);

Route::get('/lihatbarang', function () {
    return view('locations.lihatbarang');
});

// Lihat data di maps
Route::get('/lihatbarang', [LihatBarangController::class, 'lihatbarang'])->name('lihatbarang');

Route::resource('adcontact', AdContactController::class);
