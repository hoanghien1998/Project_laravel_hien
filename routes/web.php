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
// router for login normal
Route::get('/user-login', 'LoginController@getLogin');
Route::post('/user-login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout');
Route::get('/user', function () {
    return view('login.user-pro');
});

Route::get('/hello', 'HelloController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'LoginController@welcome');

// router for login api
Route::get('/', function () {
    return view('login-api.login-api');
});

// Router for register

Route::get('/register', function () {
    return view('register.register');
});

// Router for page cars

Route::get('/listcar', function () {
    return view('cars.cars');
});
