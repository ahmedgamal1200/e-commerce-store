<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');


require __DIR__.'/auth.php';

require __DIR__.'/dashboard.php';
