<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\ProductControllerr;
use App\Http\Controllers\User\ProductController;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

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



Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('products')->name('products.')->group(function () {
Route::get('list', [ProductControllerr::class, 'listproduct'])->name('list');
Route::get('inventory', [ProductControllerr::class, 'inventory'])->name('inventory');
Route::post('editUser/{id}', [ProductControllerr::class, 'editUser'])->name('editUser');

Route::get('create', [ProductControllerr::class, 'create'])->name('create');


Route::post('store', [ProductControllerr::class, 'store'])->name('store');


Route::get('edit/{id}', [ProductControllerr::class, 'edit'])->name('edit');


Route::put('update/{id}', [ProductControllerr::class, 'update'])->name('update');


Route::delete('delete/{id}', [ProductControllerr::class, 'delete'])->name('delete');

Route::get('input', [ProductControllerr::class, 'input'])->name('input');

Route::post('inputSuccess', [ProductControllerr::class, 'inputSuccess'])->name('inputSuccess');

Route::get('listImputProduct', [ProductControllerr::class, 'listImputProduct'])->name('listImputProduct');

Route::get('editimput/{id}', [ProductControllerr::class, 'editimput'])->name('editimput');


Route::put('updateimput/{id}', [ProductControllerr::class, 'updateimput'])->name('updateimput');


Route::delete('deleteimput/{id}', [ProductControllerr::class, 'deleteimput'])->name('deleteimput');

Route::post('output/{id}', [ProductControllerr::class, 'output'])->name('output');

Route::get('listoutput', [ProductControllerr::class, 'listoutput'])->name('listoutput');

});
});


Route::prefix('users')->name('users.')->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('list', [ProductController::class, 'list'])->name('list');

        Route::get('cart', [ProductController::class, 'cart'])->name('cart');

        Route::get('pay', [ProductController::class, 'pay'])->name('pay');

        Route::post('order', [ProductController::class, 'order'])->name('order');

        Route::post('ordersucess', [ProductController::class, 'ordersucess'])->name('ordersucess');

        Route::post('addtocart', [ProductController::class, 'addtocart'])->name('addtocart');

        Route::post('removeProduct/{id}', [ProductController::class,'removeProduct'])->name('removeProduct');

        Route::post('updateQuantity/{id}', [ProductController::class,'updateQuantity'])->name('updateQuantity');

        Route::post('logout', [ProductController::class,'logout'])->name('logout');

        Route::get('productDetail/{id}', [ProductController::class,'productDetail'])->name('productDetail');

        Route::post('reviewProduct/{id}', [ProductController::class, 'reviewProduct'])->name('reviewProduct');

        Route::get('qrcode/{id}', [ProductController::class, 'qrcode'])->name('qrcode');

    });
});

use App\Http\Controllers\Admin\ProviderController;
Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('providers')->name('providers.')->group(function () {

    Route::get('create', [ProviderController::class, 'create'])->name('create');


    Route::post('store', [ProviderController::class, 'store'])->name('store');


    Route::get('edit/{id}', [ProviderController::class, 'edit'])->name('edit');


    Route::put('update/{id}', [ProviderController::class, 'update'])->name('update');


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

use App\Http\Controllers\Admin\OrderController;
    Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {


    Route::get('list', [OrderController::class, 'list'])->name('list');

    Route::get('orderhasbeenship', [OrderController::class, 'orderhasbeenship'])->name('orderhasbeenship');

    Route::get('orderNotPlaced', [OrderController::class, 'orderNotPlaced'])->name('orderNotPlaced');

    Route::get('orderComplete', [OrderController::class, 'orderComplete'])->name('orderComplete');

    Route::get('orderBankTransfer', [OrderController::class, 'orderBankTransfer'])->name('orderBankTransfer');

    Route::get('orderCancelled', [OrderController::class, 'orderCancelled'])->name('orderCancelled');

    Route::get('/orderDetail/{id}', [OrderController::class, 'orderDetail'])->name('orderDetail');

    Route::post('/changestatus/{id}', [OrderController::class, 'changestatus'])->name('changestatus');

    Route::post('updatestatus/{id}', [ProductControllerr::class, 'updatestatus'])->name('updatestatus');
});
});
use App\Http\Controllers\User\OrderControllerr;
    Route::prefix('users')->name('users.')->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('index/{id}', [OrderControllerr::class, 'index'])->middleware('auth')->name('index');
        Route::get('/orderDetail/{id}', [OrderControllerr::class, 'orderDetail'])->name('orderDetail');
});
});



use App\Http\Controllers\Admin\CategoryControllerr;
Route::prefix('admins')->name('admins.')->group(function () {
Route::prefix('categories')->name('categories.')->group(function () {

    Route::get('create', [CategoryControllerr::class, 'create'])->name('create');


    Route::post('store', [CategoryControllerr::class, 'store'])->name('store');

    Route::get('list', [CategoryControllerr::class, 'listcategory'])->name('list');

    Route::get('edit/{id}', [CategoryControllerr::class, 'edit'])->name('edit');
    Route::post('update/{id}', [CategoryControllerr::class, 'update'])->name('update');

    Route::put('update/{id}', [CategoryControllerr::class, 'update'])->name('update');


    Route::delete('delete/{id}', [CategoryControllerr::class, 'delete'])->name('delete');
});
});

use App\Http\Controllers\User\CategoryController;
    Route::prefix('users')->name('users.')->group(function () {


        Route::get('category/{id}', [CategoryController::class, 'category'])->name('category');

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

    Route::get('promotion', [UserController::class, 'promotion'])->name('promotion');
    Route::post('claimpromotion/{id}', [UserController::class, 'claimpromotion'])->name('claimpromotion');


    Route::get('contact', [UserController::class, 'contact'])->name('contact');
    Route::post('feedback', [UserController::class, 'feedback'])->name('feedback');

    Route::get('confirmOTP', [UserController::class, 'confirmOTP'])->name('confirmOTP');
    Route::post('Otpsucces', [UserController::class, 'Otpsucces'])->name('Otpsucces');

    Route::get('home', [UserController::class, 'home'])->name('home');

    Route::get('introduce', [UserController::class, 'introduce'])->name('introduce');


});

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CapacityController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\ExportProductController;
use App\Models\ExportProduct;

Route::prefix('admins')->name('admins.')->group(function () {

    Route::get('home', [AdminController::class, 'home'])->name('home');

    Route::post('logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('capacities')->name('capacities.')->group(function () {
    Route::get('create', [CapacityController::class, 'create'])->name('create');
    Route::post('store', [CapacityController::class, 'store'])->name('store');
    Route::get('list', [CapacityController::class, 'list'])->name('list');
    Route::get('edit/{id}', [CapacityController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [CapacityController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [CapacityController::class, 'delete'])->name('delete');

});
});

Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('colors')->name('colors.')->group(function () {
    Route::get('create', [ColorController::class, 'create'])->name('create');
    Route::post('store', [ColorController::class, 'store'])->name('store');
    Route::get('list', [ColorController::class, 'list'])->name('list');
    Route::get('edit/{id}', [ColorController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [ColorController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ColorController::class, 'delete'])->name('delete');
});
});
Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('promotions')->name('promotions.')->group(function () {
        Route::get('create', [PromotionController::class, 'create'])->name('create');
        Route::get('list', [PromotionController::class, 'list'])->name('list');
        Route::post('store', [PromotionController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PromotionController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PromotionController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [PromotionController::class, 'delete'])->name('delete');

    });
});
Route::prefix('admins')->name('admins.')->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::get('list', [PostController::class, 'list'])->name('list');

    });
});
        Route::get('/export', 'ExportProductController@export');
        Route::get('/export-products', [ExportProductController::class, 'export']);
        
