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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('SMH')->group(function () {
    Route::get('search/{name}', 'Api\SMHPluginController@search');
    Route::get('book/{bid}', 'Api\SMHPluginController@book');
    Route::get('book/{bid}/chapter/{cid}', 'Api\SMHPluginController@chapter');
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'Api\RegisterController@register');
    Route::post('login', 'Api\Auth\LoginController@login');
    Route::get('logout', 'Api\Auth\LoginController@logout')->middleware('jwt.auth');
});

Route::get('user', 'Api\UserController@index')->middleware('jwt.auth');

// Content-Type : application/x-www-form-urlencode
Route::group(['prefix' => 'favorites','middleware', 'jwt.auth'], function() {
    Route::get('', 'Api\FavoriteController@index');
    Route::get('/{id}', 'Api\FavoriteController@show');
    Route::post('', 'Api\FavoriteController@store');
    Route::put('/{id}', 'Api\FavoriteController@update');
    Route::delete('/{id}', 'Api\FavoriteController@delete');
});

Route::group(['prefix' => 'resources'], function() {
    Route::get('', 'Api\ResourceController@index');
    Route::get('/{id}', 'Api\ResourceController@show');
    Route::post('', 'Api\ResourceController@store');
    Route::put('/{id}', 'Api\ResourceController@update');
    Route::delete('/{id}', 'Api\ResourceController@delete');
});