<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/option')->group( function(){
    Route::get('/', 'OptionController@index');
    Route::post('/add', 'OptionController@store');
    Route::get('/show/{id}', 'OptionController@show');
    Route::post('/update/{id}', 'OptionController@update');
    Route::get('/delete/{id}', 'OptionController@destroy');

    Route::prefix('/group')->group( function(){
        Route::get('/', 'OptionGroupController@index');
        Route::post('/add', 'OptionGroupController@store');
        Route::get('/show/{id}', 'OptionGroupController@show');
        Route::post('/update/{id}', 'OptionGroupController@update');
        Route::get('/delete/{id}', 'OptionGroupController@destroy');
    });
});

Route::prefix('/product')->group( function(){
    Route::get('/', 'ProductController@index');
    Route::post('/add', 'ProductController@store');
    Route::get('/show/{id}', 'ProductController@show');
    Route::post('/update/{id}', 'ProductController@update');
    Route::get('/delete/{id}', 'ProductController@destroy');

    Route::prefix('/category')->group( function(){
        Route::get('/', 'ProductCategoryController@index');
        Route::post('/add', 'ProductCategoryController@store');
        Route::get('/show/{id}', 'ProductCategoryController@show');
        Route::post('/update/{id}', 'ProductCategoryController@update');
        Route::get('/delete/{id}', 'ProductCategoryController@destroy');
    });
});


Route::prefix('/order')->group( function(){
    Route::get('/', 'OrderController@index');
    Route::post('/add', 'OrderController@store');
    Route::get('/show/{id}', 'OrderController@show');
    Route::post('/update/{id}', 'OrderController@update');
    Route::get('/delete/{id}', 'OrderController@destroy');

    Route::prefix('/detail')->group( function(){
        Route::get('/', 'OrderDetailController@index');
        Route::post('/add', 'OrderDetailController@store');
        Route::get('/show/{id}', 'OrderDetailController@show');
        Route::post('/update/{id}', 'OrderDetailController@update');
        Route::get('/delete/{id}', 'OrderDetailController@destroy');
    });
});