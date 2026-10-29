<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/home', function () {
    return redirect()->route('products.index');
})->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});