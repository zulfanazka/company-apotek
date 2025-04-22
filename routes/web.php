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
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

