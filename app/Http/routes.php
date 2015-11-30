<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/map', ['as' => 'map_path', 'uses' => 'PagesController@map']);
Route::get('/aboutus', ['as' => 'about_path', 'uses' => 'PagesController@about']);
Route::get('/places', ['as' => 'places_path', 'uses' => 'PlacesController@index']);
Route::get('/places/{slug}', ['as' => 'place_path', 'uses' => 'PlacesController@show']);

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cms'], function () {

    Route::get('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@index']);
    Route::post('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@store']);
    Route::get('/logout', ['as' => 'cms.logout_path', 'uses' => 'Cms\Auth\AuthController@destroy']);

    Route::get('/dashboard', ['as' => 'cms.dashboard_path', 'uses' => 'Cms\DashboardController@index']);

    Route::resource('/places', 'Cms\PlacesController',  [
        'except' => ['show']
    ]);

    Route::resource('/categories', 'Cms\CategoriesController',  [
        'except' => ['show']
    ]);
});

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix' => 'api', 'as' => 'api.' ], function () {
    
    Route::get('slideshow', [ 'as' => 'slideshow_path', 'uses' => 'Api\SlideshowController@index']);

    Route::get('places', [ 'as' => 'place_path', 'uses' => 'Api\PlacesController@index']);
    Route::post('places/{id}/photos', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@store']);
    Route::delete('places/{id}/photos/{photo_id}', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@destroy']);
    Route::post('places/{id}/panorama', ['as' => 'panoramas', 'uses' => 'Api\PanoramaController@store']);
    
});
