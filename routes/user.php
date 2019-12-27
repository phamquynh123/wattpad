<?php 
Route::get('/layout', function(){
    return view('layouts/header');
});
Route::get('/chapter', 'ChapterController@index');
Route::get('/story', 'StoryController@index');


Route::group(['middleware' => 'locale'], function() {
    $ctl = 'StoryController';
    Route::get('/', 'StoryController@home');
    Route::prefix('user')->group(function() {
    });

    Route::post('/getCategory', 'StoryController@getCategory')->name('getCategory');
    Route::get('/{slug}', $ctl . '@viewStory');
    Route::get('/{story_slug}/{id}/{chapter_slug}' , $ctl . '@viewChapter')->name('viewChapter');

    Route::post('addComment', $ctl . '@addComment')->name('addComment');
});
