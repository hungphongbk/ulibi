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
    $articles=\App\Models\Article::renderAll(3);
    // get top places (6)
    $destinations=\App\Models\Destination::all()->random(6);
    // get top ulibiers (4)
    $users=\App\Ulibier::all();
    return View::make('index',[
        'articles' => $articles,
        'dest' => $destinations,
        'users' => $users
    ]);
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

Route::model('destination',\App\Models\Destination::class);
Route::model('photo',\App\Models\Photo::class);
Route::model('comment',\App\Models\Comment::class);
Route::model('blog',\App\Models\Article::class);
Route::model('profile',\App\Models\UlibierProfile::class);

Route::resource('profile', 'Views\UlibierProfile', ['only'=>['index', 'show', 'update']]);
Route::get('ulibier/social/{provider}', 'Auth\AuthController@socialAuth');
ROute::get('ulibier/social/callback/{provider}', 'Auth\AuthController@socialAuthCallback');
Route::controller('ulibier', 'Auth\AuthController', [
    'postLogin' => 'ulibier.postLogin',
    'getRegister' => 'ulibier.getRegister',
    'postLike' => 'ulibier.like'
]);

//Views Controller
Route::get('blog/manage',array(
    'as' => 'blog.manage',
    'uses' => 'Views\BlogController@manage'
));
Route::resource('blog','Views\BlogController');
Route::resource('photo','Views\PhotoController');
Route::resource('photo.comment','Views\PhotoCommentController');

//APIs Controller
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
//Admins Controller
Route::group(['prefix' => 'admin'], function(){
    //ADMIN PERMISSION AUTHORIZATIONS
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('destination','Admin\DestinationController');
        Route::resource('destination.photo','Admin\DestinationPhotoController');
    });
    Route::controller('/', 'Admin\AuthController');
});