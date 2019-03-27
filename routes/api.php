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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/deleteAvis','AvisController@delete');
Route::post('/createAvis','AvisController@create');

Route::post('/deleteRestaurant', 'restaurantsController@delete');
Route::post('/createRestaurant', 'restaurantsController@create');
Route::post('/updateRestaurant', 'restaurantsController@update');



Route::get('/getAllRestaurants', 'restaurantsController@getAllRestaurants');
Route::get('/getRestaurantById', 'restaurantsController@getRestaurantById');
Route::get('/getRestaurantByName', 'restaurantsController@getRestaurantByName');

Route::get('/showUsers', 'usersController@showUsers');
Route::post('/register', 'usersController@register');
Route::get('/login', 'usersController@login');