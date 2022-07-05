<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('home');
/*Route::get('/{category_id}/{product_id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show.product');*/


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (){
    Route::get('/', [App\Http\Controllers\Admin\IndexController::class, '__invoke'])->name('admin');

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function (){
        Route::get('/show', [App\Http\Controllers\Admin\CategoriesController::class, 'show'])->name('admin.categories.show');
        Route::get('/create', [App\Http\Controllers\Admin\CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [App\Http\Controllers\Admin\CategoriesController::class, 'store'])->name('admin.categories.store');

    });

});

Auth::routes();


