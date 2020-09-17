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
    return view('home');
});

// Router for page cars

Route::get('/car', function () {
    return view('cars.add-car');
});

// Router for details cars
Route::get('/detail-cars', function () {
    return view('cars.details');
});
