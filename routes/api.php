<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['namespace' => 'API', 'prefix' => 'users'], function () {
  Route::group(['namespace' => 'User', 'prefix' => ''], function () {
    Route::post('/products', 'ProductController');
    // Route::get('/{user}', 'UsersController');
  });
});

Route::group(['namespace' => 'API', 'prefix' => 'products'], function () {
  Route::group(['namespace' => 'Product', 'prefix' => ''], function () {
    Route::get('/', 'IndexController');
    Route::post('/{product}', 'ShowController');
  });
});

Route::group(['namespace' => 'API', 'prefix' => 'tastor'], function () {
  Route::group(['namespace' => 'Tastor', 'prefix' => ''], function () {
    Route::post('/{tasting}/{product}', 'ShowController');
    Route::post('/{tasting}/{product}/create', 'StoreController');
  });
});
