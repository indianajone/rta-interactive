<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cms'], function () 
{
    Route::get('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@index']);
    Route::post('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@store']);
    Route::get('/logout', ['as' => 'cms.logout_path', 'uses' => 'Cms\Auth\AuthController@destroy']);

    Route::get('/aboutus', ['as' => 'cms.about_path', 'uses' => 'Cms\PagesController@showAbout']);
    Route::put('/aboutus', ['as' => 'cms.about_path', 'uses' => 'Cms\PagesController@updateAbout']);
    
    Route::get('/dashboard', ['as' => 'cms.dashboard_path', 'uses' => 'Cms\DashboardController@index']);
    
    Route::get('/ceo', ['as' => 'cms.ceo_path', 'uses' => 'Cms\PagesController@showCeo']);
    Route::put('/ceo', ['as' => 'cms.ceo_path', 'uses' => 'Cms\PagesController@updateCeo']);

    Route::resource('/admin', 'Cms\AdminController', [
        'except' => ['show']
    ]);
    
    Route::resource('/places', 'Cms\PlacesController',  [
        'except' => ['show']
    ]);

    Route::resource('/categories', 'Cms\CategoriesController',  [
        'except' => ['show']
    ]);

    Route::resource('places.attachments', 'Cms\AttachmentsController', [
        'only' => ['store', 'update', 'destroy']
    ]);

    Route::resource('places.video', 'Cms\PlacesVideoController', [
        'only' => ['store', 'update']
    ]);

    Route::resource('places.panorama', 'Cms\PlacesPanoramaController', [
        'only' => ['store', 'update']
    ]);

    Route::resource('places.marker', 'Cms\PlacesMarkerController', [
        'only' => ['store', 'update']
    ]);

    Route::resource('places.nearby', 'Cms\PlacesNearbyController', [
        'only' => ['store', 'update', 'destroy']
    ]);
});

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix' => 'api', 'as' => 'api.' ], function ()
{
    Route::get('login/{provider}', ['as' => 'login_path', 'uses' => 'Api\AuthController@store']);
    Route::post('login', ['as' => 'login_path', 'uses' => 'Api\AuthController@store']);
    Route::post('register', ['as' => 'register_path', 'uses' => 'Api\UsersController@store']);
    Route::post('password', ['as' => 'password_path', 'uses' => 'Api\PasswordsController@store']);
    Route::delete('logout', ['as' => 'logout_path', 'uses' => 'Api\AuthController@destroy']);

    
    Route::get('places', [ 'as' => 'place_path', 'uses' => 'Api\PlacesController@index']);
    Route::post('places/{id}/photos', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@store']);
    Route::put('places/{id}/photos/{photo_id}', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@update']);
    Route::delete('places/{id}/photos/{photo_id}', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@destroy']);
    
    Route::post('places/{id}/panorama', ['as' => 'panoramas', 'uses' => 'Api\PanoramaController@store']);
    Route::get('search', 'Api\SearchController@index');

    Route::get('attachments/{id}', ['as' => 'attachment_path', 'uses' => 'Api\AttachmentController@show']);
    Route::put('attachments/{id}', ['as' => 'attachment_path', 'uses' => 'Api\AttachmentController@update']);

    Route::post('favorites/{id}', 'Api\FavoritesController@store');
    Route::delete('favorites/{id}', 'Api\FavoritesController@destroy');
});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('auth/{provider}', 'AuthController@index');
Route::get('password/reset/{token}', ['as' => 'password_path', 'uses' => 'PasswordController@index']);
Route::post('password/reset', ['as' => 'password_path', 'uses' => 'PasswordController@store']);


Route::group(['middleware' => ['locale']], function () 
{
    Route::get('{lang?}/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('{lang?}/profile', ['as' => 'profile_path', 'uses' => 'ProfileController@index']);
    Route::get('{lang?}/map/{slug?}', ['as' => 'map_path', 'uses' => 'PagesController@map']);
    Route::get('{lang?}/aboutus', ['as' => 'about_path', 'uses' => 'PagesController@about']);
    Route::get('{lang?}/places', ['as' => 'places_path', 'uses' => 'PlacesController@index']);
    Route::get('{lang?}/places/{slug}', ['as' => 'place_path', 'uses' => 'PlacesController@show']);
    Route::get('{lang?}/recommended', ['as' => 'recommended_path', 'uses' => 'PagesController@recommended']);
});