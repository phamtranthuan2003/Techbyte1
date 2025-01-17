<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });



use App\Http\Controllers\Admin\ProductController;
Route::prefix('products')->name('products.')->group(function () {

Route::get('listproduct', [ProductController::class, 'listproduct'])->name('list');


Route::get('create', [ProductController::class, 'create'])->name('create');


Route::post('store', [ProductController::class, 'store'])->name('store');


Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');


Route::put('update/{id}', [ProductController::class, 'update'])->name('update');


Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
});




use App\Http\Controllers\Admin\ProviderController;

Route::prefix('providers')->name('providers.')->group(function () {

    Route::get('create', [ProviderController::class, 'create'])->name('create');


    Route::post('store', [ProviderController::class, 'store'])->name('store');


    Route::get('edit/{id}', [ProviderController::class, 'edit'])->name('edit');

    
    Route::post('update/{id}', [ProviderController::class, 'update'])->name('update');
});







use App\Http\Controllers\Admin\CategoryController;
Route::prefix('categories')->name('categories.')->group(function () {

    Route::get('create', [CategoryController::class, 'create'])->name('create');

    
    Route::post('store', [CategoryController::class, 'store'])->name('store');
});


use App\Http\Controllers\User\UserController;

Route::prefix('users')->name('users.')->group(function () {

    Route::get('create', [UserController::class, 'create'])->name('create');

 
    Route::post('store', [UserController::class, 'store'])->name('store');

  
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');

  
    Route::post('update/{id}', [UserController::class, 'update'])->name('update');

    Route::get('login', [UserController::class, 'login'])->name('login');

    Route::post('loginIndex', [UserController::class, 'loginIndex'])->name('loginIndex');

    Route::get('forgotpassword', [UserController::class, 'forgotpassword'])->name('forgotpassword');
    Route::post('resetpassword', [UserController::class, 'resetpassword'])->name('resetpassword');

    Route::get('confirmEmail', [UserController::class, 'confirmEmail'])->name('confirmEmail');
    Route::post('Emailsucces', [UserController::class, 'Emailsucces'])->name('Emailsucces');

    Route::get('confirmOTP', [UserController::class, 'confirmOTP'])->name('confirmOTP');
    Route::post('Otpsucces', [UserController::class, 'Otpsucces'])->name('Otpsucces');

    Route::get('home', [UserController::class, 'home'])->name('home');
});

use App\Http\Controllers\Admin\AdminController;

Route::prefix('admins')->name('admins.')->group(function () {
  
    Route::get('home', [AdminController::class, 'home'])->name('home');

    Route::get('user', [AdminController::class, 'user'])->name('user');

    Route::get('adduser', [AdminController::class, 'adduser'])->name('adduser');

    Route::get('listproduct', [AdminController::class, 'listproduct'])->name('listproduct');
});
