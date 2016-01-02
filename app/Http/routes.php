<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cms'], function () {

    Route::get('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@index']);
    Route::post('/login', ['as' => 'cms.login_path', 'uses' => 'Cms\Auth\AuthController@store']);
    Route::get('/logout', ['as' => 'cms.logout_path', 'uses' => 'Cms\Auth\AuthController@destroy']);

    Route::get('/aboutus', ['as' => 'cms.about_path', 'uses' => 'Cms\PagesController@showAbout']);
    Route::put('/aboutus', ['as' => 'cms.about_path', 'uses' => 'Cms\PagesController@updateAbout']);
    
    Route::get('/dashboard', ['as' => 'cms.dashboard_path', 'uses' => 'Cms\DashboardController@index']);
    
    Route::get('/ceo', ['as' => 'cms.ceo_path', 'uses' => 'Cms\PagesController@showCeo']);
    Route::put('/ceo', ['as' => 'cms.ceo_path', 'uses' => 'Cms\PagesController@updateCeo']);
    
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
    
    Route::get('places', [ 'as' => 'place_path', 'uses' => 'Api\PlacesController@index']);
    Route::post('places/{id}/photos', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@store']);
    Route::put('places/{id}/photos/{photo_id}', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@update']);
    Route::delete('places/{id}/photos/{photo_id}', [ 'as' => 'place.photos', 'uses' => 'Api\PhotosController@destroy']);
    
    Route::post('places/{id}/panorama', ['as' => 'panoramas', 'uses' => 'Api\PanoramaController@store']);
    
    Route::get('search', 'Api\SearchController@index');
});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['locale']], function () {
    Route::get('{lang?}/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('{lang?}/map', ['as' => 'map_path', 'uses' => 'PagesController@map']);
    Route::get('{lang?}/aboutus', ['as' => 'about_path', 'uses' => 'PagesController@about']);
    Route::get('{lang?}/places', ['as' => 'places_path', 'uses' => 'PlacesController@index']);
    Route::get('{lang?}/recommended', ['as' => 'recommended_path', 'uses' => 'PagesController@recommended']);
    Route::get('{lang?}/{slug}', ['as' => 'place_path', 'uses' => 'PlacesController@show']);
});