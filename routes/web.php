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
Route::get('/locations/create', [ContactController::class, 'create'])->name('locations.create');
Route::post('/locations', [ContactController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}/edit', [ContactController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [ContactController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [ContactController::class, 'destroy'])->name('locations.destroy');
