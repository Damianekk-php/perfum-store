<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::post('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
