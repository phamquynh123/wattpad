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
                Route::get('datatable/{language_id}', 'StoryController@storyDatatable')->name('datatable');
                Route::get('/detail/{id}', 'StoryController@detail')->name('detail');
            });
        });

        Route::prefix('/manageMyStory')->name('myStory.')->group(function() {
            Route::get('/', 'StoryController@manageMyStory');
            Route::get('datatable/{language_id}', 'StoryController@manageMyStoryDatatable')->name('datatable');
            Route::get('/changPublicStatus/{id}', 'StoryController@changPublicStatus')->name('changPublicStatus');
            Route::get('/changUseStatus/{id}', 'StoryController@changUseStatus')->name('changUseStatus');
            Route::post('/add', 'StoryController@addStory')->name('addStory');
            Route::get('detail/{slug}', 'StoryController@detailStory')->name('detailStory');
        });

        Route::prefix('/permission')->name('permission.')->group(function() {
            $ctl = 'PermissionController';
            Route::get('/permissionlist', 'PermissionController@index');
            Route::get('/datatable/{lang_id}', 'PermissionController@datatable')->name('datatable');
            Route::get('/datatableRole/{lang_id}', 'PermissionController@datatableRole')->name('datatableRole');
            Route::get('/datatablePermissionRole/{lang_id}', 'PermissionController@datatablePermissionRole')->name('datatablePermissionRole');
            Route::post('/store', 'PermissionController@store')->name('add');
            Route::get('/edit/{id}', 'PermissionController@edit')->name('edit');
            Route::post('/update', 'PermissionController@update')->name('update');
            Route::get('/role/edit/{id}', 'PermissionController@roleEdit')->name('roleedit');
            Route::post('/role/update', 'PermissionController@roleUpdate')->name('roleupdate');
            Route::get('/permissionRoleEdit/{id}', 'PermissionController@permissionRoleEdit')->name('permissionRoleEdit');
            Route::post('/permissionRoleUpdatee', 'PermissionController@permissionRoleUpdatee')->name('permissionRoleUpdatee');
            Route::get('/Capquyen', $ctl . '@addVip')->name('addVip');
            Route::get('/Capquyen/datatable/{lang_id}', $ctl . '@addVipDatatable')->name('addVipDatatable');
            Route::post('/changeRole', $ctl . '@changeRole')->name('changeRole');

        });
    });
});
