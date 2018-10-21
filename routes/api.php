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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('SMH')->group(function () {
    Route::get('search/{name}', 'SMHPluginController@search');
    Route::get('book/{bid}', 'SMHPluginController@book');
    Route::get('book/{bid}/chapter/{cid}', 'SMHPluginController@chapter');
});
