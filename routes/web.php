<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index'])->name('home');
    Route::get('/{category}/{product_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show.product');
    Route::get('/{category}', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (){
    Route::get('/', [App\Http\Controllers\Admin\IndexController::class, '__invoke'])->name('admin');

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function (){
        Route::get('/show', [App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [App\Http\Controllers\Admin\CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [App\Http\Controllers\Admin\CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}', [App\Http\Controllers\Admin\CategoriesController::class, 'show'])->name('admin.categories.show');
        Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::patch('/{category}', [App\Http\Controllers\Admin\CategoriesController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [App\Http\Controllers\Admin\CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    });

    Route::group(['namespace' => 'Product', 'prefix' => 'products'], function (){
        Route::get('/show', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [App\Http\Controllers\Admin\ProductsController::class, 'create'])->name('admin.products.create');
        Route::post('/', [App\Http\Controllers\Admin\ProductsController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}', [App\Http\Controllers\Admin\ProductsController::class, 'show'])->name('admin.products.show');
        Route::get('/{product}/edit', [App\Http\Controllers\Admin\ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::patch('/{product}', [App\Http\Controllers\Admin\ProductsController::class, 'update'])->name('admin.products.update');
        Route::delete('/{product}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy'])->name('admin.products.destroy');

    });

});

Auth::routes();


