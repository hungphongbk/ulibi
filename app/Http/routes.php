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
    // get top articles (3)
    $articles=\App\Models\Article::all()->random(3);
    // get top places (6)
    $destinations=\App\Models\Destination::all()->random(6);
    return View::make('index',[
        'articles' => $articles,
        'dest' => $destinations
    ]);
});
Route::get('/blog', function() {
    return View::make('pages.blog');
});
Route::get('/blog/post', function(){
    return View::make('pages.blogpost');
});
Route::get('/blog/{id?}', function($id=1) {
    return View::make('pages.blogdetail');
});
Route::get('/photo', function() {
    return View::make('pages.photos');
});
Route::get('/register', function() {
    return View::make('pages.register');
});
Route::get('/profile', function() {
    return View::make('pages.profile');
});
Route::get('/map', function() {
    return View::make('pages.map');
});
Route::get('/test/email', function(){
    return View::make('emails.confirmation');
});

Route::controller('ulibier','Auth\AuthController');
Route::group(['prefix' => 'api'], function(){
    Route::controllers([
        'auth' => 'Api\AuthController',
        'ulibier' => 'Api\UlibierController',
        'article' => 'Api\ArticleController',
        'photo' => 'Api\PhotoController',
        'dest' => 'Api\DestinationController'
    ]);
    Route::get('r/{type}/{filename}','Api\ResourceController@getIndex');
});