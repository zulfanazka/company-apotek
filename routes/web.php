<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;


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


Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');





Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

// Resource route adwelcome, otomatis mendaftarkan semua route CRUD
Route::resource('adwelcome', AdWelcomeController::class);

// Main dashboard setelah login
Route::get('main', [MainController::class, 'index'])->name('main')->middleware('auth');



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
Route::get('/adwelcome', [AdWelcomeController::class, 'index'])->name('adwelcome.index');
Route::get('/adwelcome/create', [AdWelcomeController::class, 'create'])->name('adwelcome.create');
Route::get('/adwelcome/edit/{id}', [AdWelcomeController::class, 'edit'])->name('adwelcome.edit');
Route::put('/adwelcome/{id}', [AdWelcomeController::class, 'update'])->name('adwelcome.update');
Route::delete('/adwelcome/{id}', [AdWelcomeController::class, 'destroy'])->name('adwelcome.destroy');
Route::resource('adwelcome', AdWelcomeController::class);

