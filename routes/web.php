<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');
Route::get('/product', [ProductController::class, 'index'])->name('product');
// Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/locations/create', [ContactController::class, 'create'])->name('locations.create');

// Tambahkan route CRUD untuk lokasi (pakai ContactController)
Route::post('/locations', [ContactController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}/edit', [ContactController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [ContactController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [ContactController::class, 'destroy'])->name('locations.destroy');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard');