<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Auth::routes();*/

//Route::get('/home', 'HomeController@index')->name('home');


/*Route::get('contacts/email', 'ContactController')->middleware('auth');*/
//Route::get('/home', 'HomeController@index')->name('home');


//USER PROFILE ROUTES
/*Route::get('users.index', 'UserController@index')->name('users.index')->middleware('auth');*/
/*Route::patch('users.edit', 'UserController@edit')->name('users.edit')->middleware('auth');*/

/*Route::get('users.edit', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::patch('users.index',  ['as' => 'users.update', 'uses' => 'UserController@update'])->middleware('auth');*/
//CONTACTS ROUTES
/*Route::resource('contacts', 'ContactController')->middleware('auth');
Route::get('contacts.email', 'ContactController@email')->name('contacts.email')->middleware('auth');
Route::get('contacts.search', 'ContactController@search')->name('contacts.search')->middleware('auth');
Route::get('contacts.edit', 'ContactController@emDestroy{id}')->name('contacts.emDestroy')->middleware('auth');*/

/*Auth::routes();*/


//TESTING
/*Route::group(['middleware' => 'auth:api'], function () {
});*/
Route::get('contacts', 'ContactController@index');
Route::get('contacts/{id}', 'ContactController@show');
Route::post('contacts', 'ContactController@store');
Route::put('contacts/{id}', 'ContactController@update');
Route::delete('contacts/{id}', 'ContactController@delete');
//User auth & user's data
Route::get('user', 'AuthController@getUS');
//Route::get('emails','ContactController@email');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
