<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('index');
});
Route::get('/blog', function() {
    return View::make('pages.blog');
});
Route::get('/blog/{id?}', function($id=1) {
    return View::make('pages.blogdetail');
});
Route::get('/photo', function() {
    return View::make('pages.photos');
});

Route::group(['prefix' => 'api'], function(){
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'ulibier' => 'Api\UlibierController',
        'article' => 'Api\ArticleController',
        'photo' => 'Api\PhotoController',
        'dest' => 'Api\DestinationController'
    ]);
    Route::get('r/{type}/{filename}','Api\ResourceController@getIndex');
});