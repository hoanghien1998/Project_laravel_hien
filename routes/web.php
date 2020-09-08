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

Auth::routes();
//router for dashboard
Route::get('/', function () {
    return view('Dashboard.dashboard');
});

// router for login api
Route::get('/login', function () {
    return view('login-api.login-api');
});

// Router for page cars

Route::get('/car', function () {
    return view('cars.add-car');
});
