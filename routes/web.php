<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/products/store', 'ProductController@store');
Route::get('/products', 'ProductController@index');


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
    Route::prefix('/category')->group( function(){
        Route::get('/', 'OptionGroupController@index');
        Route::post('/add', 'OptionGroupController@store');
        Route::get('/show/{id}', 'OptionGroupController@show');
        Route::post('/update/{id}', 'OptionGroupController@update');
        Route::get('/delete/{id}', 'OptionGroupController@destroy');
    });
});