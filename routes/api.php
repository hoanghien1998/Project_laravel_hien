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
 * Router group api car
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'car'
], function ($app) {
    $app->post('create', 'CarController@create');
    $app->post('update/{id}', 'CarController@update');
    $app->get('update/{id}', 'CarController@show');
    $app->delete('delete/{id}', 'CarController@delete');
    $app->post('upload', 'CarController@upload');
});

/**
 * Router group not middleware login
 */
Route::group([
    'prefix' => 'car'
], function ($app) {
    $app->post('search', 'CarController@search');
    $app->get('list-car', 'CarController@index');
    $app->get('details/{id}', 'CarController@show');
});
