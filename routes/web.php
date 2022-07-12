<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
    Route::get('/', [\App\Http\Controllers\Main\HomePageController::class, 'index'])->name('main.home');
    Route::get('/category/{category_id}/{product_id}', [\App\Http\Controllers\Main\ProductController::class, 'show'])->name('main.show.product');
    Route::get('/category/{category_id}', [\App\Http\Controllers\Main\CategoryController::class, 'index'])->name('main.category.index');
    Route::post('/cart/add', [\App\Http\Controllers\Main\CartController::class, 'add'])->name('main.cart.add');
    Route::post('/cart/delete', [\App\Http\Controllers\Main\CartController::class, 'delete'])->name('main.cart.delete');
    Route::post('/cart/update', [\App\Http\Controllers\Main\CartController::class, 'update'])->name('main.cart.update');
    Route::post('/cart/clear', [\App\Http\Controllers\Main\CartController::class, 'clear'])->name('main.cart.clear');
    Route::post('/cart/update-cart', [\App\Http\Controllers\Main\CartController::class, 'updateCart'])->name('main.cart.updateCart');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/cart', [\App\Http\Controllers\Main\CartController::class, 'index'])->name('main.cart.index');
        Route::get('/checkout', [\App\Http\Controllers\Main\CheckoutController::class, 'index'])->name('main.checkout.index');
        Route::post('/order', [\App\Http\Controllers\Main\OrderController::class, 'makeOrder'])->name('main.order.index');
    });

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function (){
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

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function (){
        Route::get('/show', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [App\Http\Controllers\Admin\UsersController::class, 'create'])->name('admin.users.create');
        Route::post('/', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.users.show');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/{user}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.users.destroy');

    });

    Route::group(['namespace' => 'Order', 'prefix' => 'orders'], function (){
        Route::get('/', [App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}', [App\Http\Controllers\Admin\OrdersController::class, 'show'])->name('admin.orders.show');
    });

});

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Auth::routes();

