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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/lol', function (Request $request) {

        return $request;
    });

Route::post('/login', 'AuthController@login');
Route::get('/abilities', 'AbilityController@all');
// Route::get('/user', 'AuthController@user')->middleware('auth:api');
Route::post('/register', 'AuthController@register');
Route::post('/reset', 'AuthController@sendResetMail');
Route::post('/changepassword', 'AuthController@resetPassword');
Route::post('/logout', 'AuthController@logout')->middleware('auth:api');

Route::get('/product/categories', 'ProductCategoryController@index');


Route::get('/images/{name}', 'FilesController@images');

Route::prefix('/customer')->group(function(){
    // Route::get('/products', 'ClientController@productsAll');
    // Route::get('/product/{id}', 'ClientController@productsOne');
    // Route::post('/products/{category}', 'ClientController@productsFilter');

    Route::group(['prefix' => 'product'], function(){
        Route::get('/all', 'ClientController@productsAll');
        Route::get('/show/{id}', 'ClientController@productsOne');
        Route::get('/all/filter/{category}', 'ClientController@productsFilter');
    });

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/user', 'AuthController@user');
        
        Route::get('/options/groups', 'ClientController@optiongroups');

        Route::group(['prefix' => 'order'], function(){
            Route::post('/', 'ClientController@orderPlace');
            Route::get('/all', 'ClientController@ordersAll');
            Route::get('/show/{id}', 'ClientController@orderShow');
            Route::get('/cancel/{id}', 'ClientController@orderCancel');
        });
        Route::group(['prefix' => '/cart'], function(){
            Route::get('/', 'CartController@cart');
            Route::post('/clear', 'CartController@Clear');
            Route::post('/add/{id}', 'CartController@Add');
            Route::post('/remove/{id}', 'CartController@Remove');
            Route::post('/removeitem/{id}', 'CartController@RemoveItem');
        });
    });
    
});


Route::group(['middleware' => ['auth:api', 'staff']], function() {
    Route::prefix('user')->group( function(){
        Route::get('/', 'UserController@index'); //admin manager
        Route::post('/add', 'UserController@store'); //admin manager
        Route::get('/show/{id}', 'UserController@show'); // admin manager owner 
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
        Route::get('/togglestatus/{id}', 'ProductController@togglestatus'); // admin manager
        Route::get('/feature/{id}', 'ProductController@toggleFeature'); // admin manager
    
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
        Route::get('/ship/{id}', 'OrderController@ship'); // admin manager owner
        Route::get('/cancel/{id}', 'OrderController@cancel'); // admin manager owner
    
        Route::prefix('/detail')->group( function(){
            Route::get('/', 'OrderDetailController@index'); // admin manager
            Route::post('/add', 'OrderDetailController@store'); // admin manager user 
            Route::get('/show/{id}', 'OrderDetailController@show'); //admin manager owner
            Route::post('/update/{id}', 'OrderDetailController@update'); // admin manager owner
            Route::get('/delete/{id}', 'OrderDetailController@destroy'); // admin manager owner
        });
    });
    Route::get('/admin', 'AuthController@admin');
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
        Route::get('/abilities', 'AdminController@abilities');


        // Route::get('/products', 'AdminController@products');
        // Route::get('/product/show/{id}', 'AdminController@product');
        Route::get('/orders', 'AdminController@orders');
        
        
        
        Route::prefix('/product')->group( function(){
            Route::get('/all', 'AdminController@products');
            Route::get('/show/{id}', 'AdminController@product');
            Route::post('/category/add', 'AdminController@addCategory');
            Route::post('/category/update/{id}', 'AdminController@updateCategory');
            Route::get('/category/remove/{id}', 'AdminController@removeCategory');
            Route::post('/option/add', 'AdminController@addOption');
            Route::get('/option/remove/{id}', 'AdminController@removeOption');
            Route::post('/option/group/add', 'AdminController@addOptionGroup');
            Route::get('/option/group/remove/{id}', 'AdminController@removeOptionGroup');
        });
        
        Route::prefix('/staff')->group( function(){
            Route::get('/', 'StaffController@all');
            Route::post('/assign', 'StaffController@assign');
            Route::get('/show/{id}', 'StaffController@show');
            Route::post('/revoke', 'StaffController@revoke');
            Route::get('/fire/{id}', 'StaffController@fire');
        });
        
        Route::prefix('/roles')->group( function(){
            Route::get('/', 'RolesController@all');
            Route::get('/show/{id}', 'RolesController@show');
            Route::post('/add', 'RolesController@store');
            Route::post('/update/{id}', 'RolesController@update');
            Route::get('/delete/{id}', 'RolesController@destroy');
            Route::post('/allow', 'RolesController@allowTo');
            Route::post('/unallow', 'RolesController@unAllow');
        });

    });
});


