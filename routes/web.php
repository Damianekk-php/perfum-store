<?php

use Illuminate\Support\Facades\Route;



Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::resource('products', \App\Http\Controllers\ProductController::class)->middleware('can:isAdmin');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



Route::get('/', [App\Http\Controllers\WelcomController::class, 'index'])->name('welcome');


//Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index')->middleware('auth');
//
//Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create')->middleware('auth');
//Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store')->middleware('auth');
//Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
//Route::post('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update')->middleware('auth');
//Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
//Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show')->middleware('auth');
