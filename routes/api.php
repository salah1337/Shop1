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

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout')->middleware('auth:api');
Route::post('user/add', 'UserController@store');


Route::prefix('/customer')->group(function(){
    Route::get('/products', 'ClientController@productsAll');
    Route::get('/product/{id}', 'ClientController@productsOne');
    Route::post('/products/{category}', 'ClientController@productsFilter')->middleware('auth:api');
    

    Route::group(['middleware' => 'auth:api'], function(){
        
        Route::post('/order', 'ClientController@orderPlace');
        Route::get('/orders', 'ClientController@ordersAll');
        Route::get('/order/{id}', 'ClientController@orderShow');
    });

});


Route::group(['middleware' => 'auth:api'], function() {
    Route::prefix('/user')->group( function(){
        Route::get('/', 'UserController@index'); //admin manager
        Route::post('/show/{id}', 'UserController@show'); // admin manager owner 
        Route::post('/update/{id}', 'UserController@update'); // admin manager owner
        Route::get('/delete/{id}', 'UserController@destroy'); // admin manager owner
    });
    Route::prefix('option')->group( function(){
        Route::get('/', 'OptionController@index'); // admin manager user guest
        Route::post('/add', 'OptionController@store'); // admin manager 
        Route::get('/show/{id}', 'OptionController@show'); //admin manager
        Route::post('/update/{id}', 'OptionController@update'); // admin manager
        Route::get('/delete/{id}', 'OptionController@destroy'); // admin manager
    
        Route::prefix('/group')->group( function(){
            Route::get('/', 'OptionGroupController@index'); // admin manager user guest
            Route::post('/add', 'OptionGroupController@store'); // admin manager  
            Route::get('/show/{id}', 'OptionGroupController@show'); //admin manager 
            Route::post('/update/{id}', 'OptionGroupController@update'); // admin manager 
            Route::get('/delete/{id}', 'OptionGroupController@destroy'); // admin manager 
        });
    });
    
    Route::prefix('/product')->group( function(){
        Route::get('/', 'ProductController@index'); // admin manager user guest 
        Route::post('/add', 'ProductController@store'); // admin manager
        Route::get('/show/{id}', 'ProductController@show'); //admin manager user guest
        Route::post('/update/{id}', 'ProductController@update'); // admin manager
        Route::get('/delete/{id}', 'ProductController@destroy'); // admin manager
    
        Route::prefix('/category')->group( function(){
            Route::get('/', 'ProductCategoryController@index'); // admin manager user guest 
            Route::post('/add', 'ProductCategoryController@store'); // admin manager 
            Route::get('/show/{id}', 'ProductCategoryController@show'); //admin manager
            Route::post('/update/{id}', 'ProductCategoryController@update'); // admin manager
            Route::get('/delete/{id}', 'ProductCategoryController@destroy'); // admin manager
        });
        
        Route::prefix('/option')->group( function(){
            Route::get('/', 'ProductOptionController@index'); // admin manager user guest 
            Route::post('/add', 'ProductOptionController@store'); // admin manager  
            Route::get('/show/{id}', 'ProductOptionController@show'); //admin manager 
            Route::post('/update/{id}', 'ProductOptionController@update'); // admin manager 
            Route::get('/delete/{id}', 'ProductOptionController@destroy'); // admin manager 
        });
    });
    
    
    Route::prefix('/order')->group( function(){
        Route::get('/', 'OrderController@index'); // admin manager
        Route::post('/add', 'OrderController@store'); // admin manager user 
        Route::get('/show/{id}', 'OrderController@show'); //admin manager owner
        Route::post('/update/{id}', 'OrderController@update'); // admin manager owner
        Route::get('/delete/{id}', 'OrderController@destroy'); // admin manager owner
    
        Route::prefix('/detail')->group( function(){
            Route::get('/', 'OrderDetailController@index'); // admin manager
            Route::post('/add', 'OrderDetailController@store'); // admin manager user 
            Route::get('/show/{id}', 'OrderDetailController@show'); //admin manager owner
            Route::post('/update/{id}', 'OrderDetailController@update'); // admin manager owner
            Route::get('/delete/{id}', 'OrderDetailController@destroy'); // admin manager owner
        });
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
        Route::prefix('/staff')->group( function(){
            Route::get('/', 'StaffController@all');
            Route::post('/assign', 'StaffController@assign');
            Route::get('/show/{id}', 'StaffController@show');
            Route::post('/revoke', 'StaffController@revoke');
        });
        
        Route::prefix('/roles')->group( function(){
            //create role
            //update role
            //delete role
            //get role users
            //add ability to role
            //revoke ability from role
        });

    });
});


