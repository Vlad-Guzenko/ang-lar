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
/*Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', '');
        Route::post('login', 'AuthController@authenticate');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    });
});*/
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('profile', 'UserController@getAuthenticatedUser');
Route::post('logout', 'UserController@logout');
//Inside

    Route::get('contacts', 'ContactController@index');
    Route::post('contacts', 'ContactController@store');
    Route::get('contacts/ems', 'ContactController@getEmails');
    Route::put('contacts/{id}', 'ContactController@update');
    Route::delete('contacts/{id}', 'ContactController@destroy');
    Route::get('contact/{id}', 'ContactController@show');
Route::group(['middleware'=>['jwt.verify']], function (){
});





/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
