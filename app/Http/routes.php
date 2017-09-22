<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::controller('password', 'Auth\PasswordController');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['uses' => 'IndexController@index']);
    Route::post('/', ['uses' => 'IndexController@change']);
    Route::get('/profile', ['uses' => 'ProfileController@index']);
    Route::get('/regist', ['uses' => 'RegistController@index']);
    Route::post('/regist', ['uses' => 'RegistController@regist']);

    Route::get('/data', ['uses' => 'DataController@index']);
    Route::get('/message', ['uses' => 'MessageController@index']);
    Route::post('/message', ['uses' => 'MessageController@send']);
    Route::post('/removeMessage', ['uses' => 'MessageController@remove']);
    Route::get('/viewData', ['uses' => 'ViewDataController@index']);
    Route::post('/viewData', ['uses' => 'ViewDataController@edit']);
    Route::get('/users', ['uses' => 'UserController@index']);
    Route::post('/users', ['uses' => 'UserController@update']);

    Route::get('/todo', function() {
        return view('todo');
    });
});
