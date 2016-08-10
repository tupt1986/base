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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/users', [
    'uses' => 'UserController@index',
    'middleware'=>'roles',
    'roles'=>['Admin','Manager'],
]);

Route::post('/users/assignroles',[
    'uses' => 'UserController@assignRoles',
    'as' => 'user.assignroles',
    'middleware'=>'roles',
    'roles'=>['Admin'],
]);



Route::get('/home', 'HomeController@index');
