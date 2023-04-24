<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Controllers\IndexController::class);

// Auth
Route::controller(LoginRegisterController::class)->group(function () {
  Route::get('/register', 'register')->name('register')
    ->middleware(['auth', 'admin']);
  Route::post('/store', 'store')->name('store');
  Route::get('/login', 'login')->name('login');
  Route::post('/authenticate', 'authenticate')->name('authenticate');
  Route::get('/dashboard', 'dashboard')->name('dashboard');
  Route::post('/logout', 'logout')->name('logout');
});

// Admin
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

  Route::get('/', 'IndexController')->name('admin.index');
  Route::post('/{tasting}/{product}/image/add', 'ImageController')->name('admin.image.store');

  Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
    Route::get('/', 'IndexController')->name('admin.user.index');
    Route::get('/create', 'AddController')->name('admin.user.add');
    Route::get('/{user}', 'ShowController')->name('admin.user.show');
    Route::delete('/{user}/delete', 'DeleteController')->name('admin.user.delete');
  });

  Route::group(['namespace' => 'Product', 'prefix' => 'products'], function () {
    Route::get('/', 'IndexController')->name('admin.product.index');
    Route::get('/create', 'CreateController')->name('admin.product.create');
    Route::post('/create', 'StoreController')->name('admin.product.store');
    Route::get('/{product}', 'ShowController')->name('admin.product.show');
    Route::post('/{product}/delete', 'DeleteController')->name('admin.product.delete');
    Route::get('/{product}/{tasting}', 'TastingController')->name('admin.product.tasting.show');
  });

  Route::group(['namespace' => 'Tasting', 'prefix' => 'tasting'], function () {
    Route::get('/', 'IndexController')->name('admin.tasting.index');
    Route::get('/create', 'CreateController')->name('admin.tasting.create');
    Route::post('/create', 'StoreController')->name('admin.tasting.store');
    Route::get('/{tasting}', 'ShowController')->name('admin.tasting.show');
    Route::patch('/{tasting}/close', 'CloseController')->name('admin.tasting.close');
    Route::delete('/{tasting}/delete', 'DeleteController')->name('admin.tasting.delete');
    Route::get('/{tasting}/{product}', 'ProductController')->name('admin.tasting.product.show');
  });

  Route::group(['namespace' => 'ProductTasting', 'prefix' => 'product-tasting'], function () {
    Route::post('/{tasting}/create', 'StoreController')->name('admin.product-tasting.store');
  });
});

// Tastor == User
Route::group(['namespace' => 'App\Http\Controllers\Tastor', 'prefix' => 'tastor', 'middleware' => ['auth', 'tastor']], function () {

  Route::get('/', 'IndexController')->name('tastor.index');

  Route::group(['namespace' => 'Tasting', 'prefix' => 'tasting'], function () {
    Route::get('/{tasting}', 'IndexController')->name('tastor.tasting.index');
    Route::get('/{tasting}/{product}', 'ShowController')->name('tastor.tasting.show');
    Route::post('/{tasting}/{product}/create', 'CreateController')->name('tastor.tasting.create');
  });
});
