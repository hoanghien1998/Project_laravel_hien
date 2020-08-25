<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/user-login', 'LoginController@getLogin')->name('user-login');
;
Route::post('/user-login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout');


Route::get('/hello', 'HelloController@index');

Route::get('/user', 'LoginController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'LoginController@welcome');
