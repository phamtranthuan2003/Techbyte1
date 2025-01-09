<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store']);

Route::get('/users/update/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update']);




Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/products/create', [App\Http\Controllers\ProductController::class, 'store']);

Route::get('/products/update/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/products/update/{id}', [App\Http\Controllers\ProductController::class, 'update']);


Route::delete('/products/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.delete');


Route::get('/products/listproduct', [App\Http\Controllers\ProductController::class, 'listproduct'])->name('products.list');


Route::get('/providers/create', [App\Http\Controllers\ProviderController::class, 'create'])->name('create');
Route::post('/providers/create', [App\Http\Controllers\ProviderController::class, 'store'])->name('store');

