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
            Route::prefix('/menu')->name('category.')->group(function(){
                $categoryController = 'CategoryController';
                // Route::post("cart", $shopController . "@cart")->name('cart');
                Route::get('/', 'CategoryController@index');
                Route::get('/categoryDatatable', 'CategoryController@menuDatatable')-> name('datatable');
                Route::get('/detail/{id}', 'CategoryController@detail')->name('detail');
                Route::get('/trans/{id}', 'CategoryController@getDataTrans')->name('gettrans');
                Route::post('/trans', 'CategoryController@trans')->name('trans');
                Route::post('/add', 'CategoryController@store')->name('add');
                // });
            });
            Route::prefix('/category')->group(function() {
                $categoryController = 'CategoryController';
                Route::get('/', 'CategoryController@listCategory');
                Route::get('/categoryDatatable', 'CategoryController@categoryDatatable')-> name('list_category');
                Route::get('/detail/{id}', 'CategoryController@detail')->name('detail');
                Route::get('/trans/{id}', 'CategoryController@getDataTrans')->name('gettrans');
                Route::post('/trans', 'CategoryController@trans')->name('trans');
                Route::post('/add', 'CategoryController@storeCategory')->name('add_category');
                Route::get('/edit/{id}', 'CategoryController@editCategory')->name('edit_category');
                Route::post('/update', '<<<CategoryController@updateCategory></CategoryController@updateCategory></CategoryController@updateCategory></CategoryController@updateCategory>')->name('update_category');
            });

            Route::prefix('/story')->name('story.')->group(function() {
                Route::get('/', 'StoryController@index');
                Route::get('datatable/{language_id}', 'StoryController@storyDatatable')->name('datatable');
                Route::get('/detail/{id}', 'StoryController@detail')->name('detail');
            });
        });

        Route::prefix('/manageMyStory')->name('myStory.')->group(function() {
            $ctl = 'StoryController';
            Route::get('/', 'StoryController@manageMyStory');
            Route::get('datatable/{language_id}', 'StoryController@manageMyStoryDatatable')->name('datatable');
            Route::get('/changPublicStatus/{id}', 'StoryController@changPublicStatus')->name('changPublicStatus');
            Route::get('/changUseStatus/{id}', 'StoryController@changUseStatus')->name('changUseStatus');
            Route::post('/add', 'StoryController@addStory')->name('addStory');
            Route::get('detail/{slug}', 'StoryController@detailStory')->name('detailStory');
            Route::get('editStory/{id}', $ctl . '@editStory')->name('editStory');
            Route::post('/submitEdit/{id}', $ctl . '@submitEdit')->name('submitEdit');
            Route::post('addChapter/{id}', $ctl . '@addChapter')->name('addChapter');
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
            Route::post('/permissionRoleUpdatee', $ctl . '@permissionRoleUpdatee')->name('permissionRoleUpdatee');
            Route::get('/Capquyen', $ctl . '@addVip')->name('addVip');
            Route::get('/Capquyen/datatable/{lang_id}', $ctl . '@addVipDatatable')->name('addVipDatatable');
            Route::post('/changeRole', $ctl . '@changeRole')->name('changeRole');
        });

        Route::group(['prefix' => 'news'],function() {
			$ctl = 'NewsController';
			Route::get('list.html', $ctl . '@listNews')->name('news.list');
			Route::get('add.html', $ctl . '@addNewsForm')->name('news_add_form');
	    	Route::post('add.html', $ctl . '@addNewsAccess')->name('news_add');
			Route::get('edit/{id}', $ctl . '@editNewsForm')->name('news_edit_form');
	    	Route::post('edit.html', $ctl . '@editNewsAccess')->name('news_edit');
	    	Route::get('delete.html/{id}', $ctl . '@deleteNewsAccess')->name('news_delete');
		});
    });
});
