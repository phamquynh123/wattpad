<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'locale'], function() {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('change-language/{language}', 'LanguageController@changeLanguage')
        ->name('change-language');
    Route::group(['middleware' => 'auth'], function() {
        Route::prefix('/admin')->group(function() {
            Route::get('/', 'AdminController@index');
            Route::prefix('/category')->name('category.')->group(function(){
                 // $categoryController = 'CategoryController';
                 // Route::post("cart", $shopController . "@cart")->name('cart');
                Route::get('/', 'CategoryController@index');
                Route::get('/categoryDatatable', 'CategoryController@categoryDatatable')-> name('datatable');
                Route::get('/detail/{id}', 'CategoryController@detail')->name('detail');
                Route::get('/trans/{id}', 'CategoryController@getDataTrans')->name('gettrans');
                Route::post('/trans', 'CategoryController@trans')->name('trans');
                Route::post('/add', 'CategoryController@store')->name('add');
            // });
            });

            Route::prefix('/story')->name('story.')->group(function() {
                Route::get('/', 'StoryController@index');
            })
        });
    });
});
