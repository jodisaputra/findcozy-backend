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

Route::prefix('auth')->group(function () {
    Route::post('/register', 'API\LoginController@register');
    Route::post('/login', 'API\LoginController@login');

    Route::get('/logout', 'API\LoginController@logout')->middleware('auth:api');
    Route::get('/user', 'API\LoginController@user')->middleware('auth:api');
    Route::post('/profile', 'API\LoginController@updateprofile')->middleware('auth:api');
});
// kost
Route::get('boardinghouses', 'API\BoardingHouseController@index')->middleware('auth:api');
Route::get('boardinghouses/all', 'API\BoardingHouseController@all')->middleware('auth:api');
//kamar kost
Route::get('boardingrooms', 'API\BoardingRoomController@index')->middleware('auth:api');
// gambar kost
Route::get('boardingimages', 'API\BoardingHouseImageController@index')->middleware('auth:api');
//favourite
Route::get('favourites', 'API\FavouriteController@index')->middleware('auth:api');
Route::post('favourites/add', 'API\FavouriteController@store')->middleware('auth:api');
Route::delete('favourites/{id}', 'API\FavouriteController@destroy')->middleware('auth:api');



