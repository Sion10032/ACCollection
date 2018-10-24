<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'Api\RegisterController@register');
    Route::post('login', 'Api\Auth\LoginController@login');
    Route::get('logout', 'Api\Auth\LoginController@logout')->middleware('jwt.auth');
});

Route::group([], function() {
    Route::get('users', 'Api\UserController@index')->middleware('jwt.auth');
    Route::get('users/{id}', 'Api\UserController@show')->middleware('jwt.auth');
    // Route::post('users', 'Api\RegisterController@register');    // register
    // Route::put('users/{}', 'Api\Auth\LoginController@login')
    // Route::delete('users/{}', 'Api\Auth\LoginController@logout')->middleware('jwt.auth');
});

// Content-Type : application/x-www-form-urlencode
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('users/{uid}/favorites', 'Api\FavoriteController@index');
    Route::get('users/{uid}/favorites/{id}', 'Api\FavoriteController@show');
    Route::post('users/{uid}/favorites', 'Api\FavoriteController@store');
    Route::put('users/{uid}/favorites/{id}', 'Api\FavoriteController@update');
    Route::delete('users/{uid}/favorites/{id}', 'Api\FavoriteController@delete');
});

Route::group([], function() {
    Route::get('resources', 'Api\ResourceController@index');
    Route::get('resources/{id}', 'Api\ResourceController@show');
    Route::post('resources', 'Api\ResourceController@store');
    Route::put('resources/{id}', 'Api\ResourceController@update');
    Route::delete('resources/{id}', 'Api\ResourceController@delete');
});

Route::group(['prefix' => 'SMH', 'middleware' => 'cros'], function () {
    Route::get('search/{name}', 'Api\SMHPluginController@search');
    Route::get('books/{bid}', 'Api\SMHPluginController@book');
    Route::get('books/{bid}/chapters/{cid}', 'Api\SMHPluginController@chapter');
    Route::get('latest', 'Api\SMHPluginController@latest');
    Route::get('hots', 'Api\SMHPluginController@hots');
});