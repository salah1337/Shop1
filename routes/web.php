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
    Route::get('/delete/{id}', 'OptionController@destroy');
});