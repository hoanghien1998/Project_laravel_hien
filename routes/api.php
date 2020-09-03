<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/**
 * Router group for api auth
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@userProfile');
});

/**
 * Router test api when use cors
 */
Route::get('my-api', function (Request $request) {

    return response()->json(['Hello Laravel 7']);
});

/**
 * Router group api car
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'car'
], function ($app) {
    $app->post('car', 'CarController@createCar');
    $app->put('car/{id}', 'CarController@updateCar');

    $app->delete('car/{id}', 'CarController@deleteCar');
    $app->get('car', 'CarController@index');
});
