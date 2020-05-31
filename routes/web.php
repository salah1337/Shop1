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
    Route::get('/add', 'ProductController@store');
    Route::get('/show/{id}', 'ProductController@show');
    Route::post('/update/{id}', 'ProductController@update');
    Route::get('/delete/{id}', 'ProductController@destroy');

    Route::prefix('/category')->group( function(){
        Route::get('/', 'ProductCategoryController@index');
        Route::get('/add', 'ProductCategoryController@store');
        Route::get('/show/{id}', 'ProductCategoryController@show');
        Route::post('/update/{id}', 'ProductCategoryController@update');
        Route::get('/delete/{id}', 'ProductCategoryController@destroy');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
