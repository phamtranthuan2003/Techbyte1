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



use App\Http\Controllers\Admin\ProductControllerr;
Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('products')->name('products.')->group(function () {
Route::get('list', [ProductControllerr::class, 'listproduct'])->name('list');
Route::post('editUser/{id}', [ProductControllerr::class, 'editUser'])->name('editUser');

Route::get('create', [ProductControllerr::class, 'create'])->name('create');


Route::post('store', [ProductControllerr::class, 'store'])->name('store');


Route::get('edit/{id}', [ProductControllerr::class, 'edit'])->name('edit');


Route::put('update/{id}', [ProductControllerr::class, 'update'])->name('update');


Route::delete('delete/{id}', [ProductControllerr::class, 'delete'])->name('delete');
});
});


use App\Http\Controllers\User\ProductController;
    Route::prefix('users')->name('users.')->group(function () {
    Route::prefix('products')->name('products.')->group(function () {

    Route::get('list', [ProductController::class, 'list'])->name('list');

    Route::get('pay', [ProductController::class, 'pay'])->name('pay');

});
});
use App\Http\Controllers\Admin\ProviderController;
Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('providers')->name('providers.')->group(function () {

    Route::get('create', [ProviderController::class, 'create'])->name('create');


    Route::post('store', [ProviderController::class, 'store'])->name('store');


    Route::get('edit/{id}', [ProviderController::class, 'edit'])->name('edit');

    
    Route::post('update/{id}', [ProviderController::class, 'update'])->name('update');

    Route::get('list', [ProviderController::class, 'list'])->name('list');

    Route::delete('delete/{id}', [ProviderController::class, 'delete'])->name('delete');
});
});

use App\Http\Controllers\Admin\UserControllerr;
    Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {


    Route::get('list', [UserControllerr::class, 'list'])->name('list');

    Route::delete('deleteuser/{id}', [UserControllerr::class, 'deleteuser'])->name('deleteuser');


});
});





use App\Http\Controllers\Admin\CategoryController;
Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('categories')->name('categories.')->group(function () {

    Route::get('create', [CategoryController::class, 'create'])->name('create');

    
    Route::post('store', [CategoryController::class, 'store'])->name('store');

    Route::get('list', [CategoryController::class, 'listcategory'])->name('list');

    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');

    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');


    Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
});
});


use App\Http\Controllers\User\UserController;

Route::prefix('users')->name('users.')->group(function () {

    Route::get('create', [UserController::class, 'create'])->name('create');

 
    Route::post('store', [UserController::class, 'store'])->name('store');

  
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');

  
    Route::post('update/{id}', [UserController::class, 'update'])->name('update');

    Route::get('login', [UserController::class, 'login'])->name('login');

    Route::post('loginIndex', [UserController::class, 'loginIndex'])->name('loginIndex');

    Route::get('confirmEmail', [UserController::class, 'confirmEmail'])->name('confirmEmail');
    Route::post('resetpassword', [UserController::class, 'resetpassword'])->name('resetpassword');
    Route::post('updatepassword/{id}', [UserController::class, 'updatepassword'])->name('updatepassword');

    

    Route::get('confirmOTP', [UserController::class, 'confirmOTP'])->name('confirmOTP');
    Route::post('Otpsucces', [UserController::class, 'Otpsucces'])->name('Otpsucces');

    Route::get('home', [UserController::class, 'home'])->name('home'); 
    Route::get('introduce', [UserController::class, 'introduce'])->name('introduce');
});

use App\Http\Controllers\Admin\AdminController;

Route::prefix('admins')->name('admins.')->group(function () {
  
    Route::get('home', [AdminController::class, 'home'])->name('home');

    
});
