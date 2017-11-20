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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
   
Route::get('clients', 'ClientController@index');
Route::get('clients/download', 'ClientController@download');
Route::get('clients/{id}', 'ClientController@show');
Route::post('clients', 'ClientController@store');
Route::put('clients/{id}', 'ClientController@update');
Route::delete('clients/{id}', 'ClientController@delete');
Route::post('clients/upload', 'ClientController@upload');
});

