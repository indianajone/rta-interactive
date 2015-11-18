<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/map', ['as' => 'map_path', 'uses' => 'PagesController@map']);
Route::get('/aboutus', ['as' => 'about_path', 'uses' => 'PagesController@about']);
Route::get('/places/{slug}', ['as' => 'place_path', 'uses' => 'PlacesController@show']);

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'Cms\Auth\AuthController@index']);
});

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix' => 'api', 'as' => 'api.' ], function () {
    Route::get('places', [ 'as' => 'places', 'uses' => 'Api\PlacesController@index']);
});
