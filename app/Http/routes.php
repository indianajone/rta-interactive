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

    Route::get('/login', ['as' => 'login_path', 'uses' => 'Cms\Auth\AuthController@index']);
    Route::post('/login', ['as' => 'login_path', 'uses' => 'Cms\Auth\AuthController@store']);
    Route::get('/logout', ['as' => 'logout_path', 'uses' => 'Cms\Auth\AuthController@destroy']);

    Route::get('/dashboard', ['as' => 'dashboard_path', 'uses' => 'Cms\DashboardController@index']);

    Route::resource('/places', 'Cms\PlacesController',  [
        'names' => [
            'index' => 'place_path.index',
            'create' => 'place_path.create',
            'store' => 'place_path.store',
            'edit' => 'place_path.edit',
            'update' => 'place_path.update',
            'delete' => 'place_path.delete',
            'destroy' => 'place_path.destroy',
        ]
    ]);
});

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix' => 'api', 'as' => 'api.' ], function () {
    Route::get('places', [ 'as' => 'place_path', 'uses' => 'Api\PlacesController@index']);
});
