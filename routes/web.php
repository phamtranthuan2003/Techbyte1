<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



use App\Http\Controllers\ProductController;
Route::prefix('products')->name('products.')->group(function () {

Route::get('listproduct', [ProductController::class, 'listproduct'])->name('list');


Route::get('create', [ProductController::class, 'create'])->name('create');


Route::post('store', [ProductController::class, 'store'])->name('store');


Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');


Route::put('update/{id}', [ProductController::class, 'update'])->name('update');


Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
});




use App\Http\Controllers\ProviderController;

Route::prefix('providers')->name('providers.')->group(function () {

    Route::get('create', [ProviderController::class, 'create'])->name('create');


    Route::post('store', [ProviderController::class, 'store'])->name('store');


    Route::get('edit/{id}', [ProviderController::class, 'edit'])->name('edit');

    
    Route::post('update/{id}', [ProviderController::class, 'update'])->name('update');
});







use App\Http\Controllers\CategoryController;

Route::prefix('categories')->name('categories.')->group(function () {

    Route::get('create', [CategoryController::class, 'create'])->name('create');

    
    Route::post('store', [CategoryController::class, 'store'])->name('store');
});


use App\Http\Controllers\UserController;

Route::prefix('users')->name('users.')->group(function () {

    Route::get('create', [UserController::class, 'create'])->name('create');

 
    Route::post('store', [UserController::class, 'store'])->name('store');

  
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');

  
    Route::post('update/{id}', [UserController::class, 'update'])->name('update');
});
