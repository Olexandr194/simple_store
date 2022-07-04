<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('home');
Route::get('/{cat}/{product_id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show.product');

Auth::routes();


