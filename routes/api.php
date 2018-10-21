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
    Route::post('logout', 'Api\Auth\LoginController@logout')->middleware('jwt.auth');
});

Route::get('user', 'Api\UserController@index')->middleware('jwt.auth');
