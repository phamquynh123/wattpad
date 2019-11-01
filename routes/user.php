<?php 
Route::get('/layout', function(){
    return view('layouts/header');
});
Route::get('/chapter', 'ChapterController@index');
Route::get('/story', 'StoryController@index');


Route::group(['middleware' => 'locale'], function() {
    Route::get('/', 'StoryController@home');
    Route::prefix('user')->group(function() {
    });
    Route::post('/getCategory', 'StoryController@getCategory')->name('getCategory');
});
