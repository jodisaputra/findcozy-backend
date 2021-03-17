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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['checklogin', 'checkrole'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/logout', 'AuthController@logout')->name('logout');

    // Kos
    Route::resource('boardinghouse', 'BoardingHouseController');
    // gambar kos
    Route::get('boardinghouseimage/{boardinghouse}', 'BoardingHouseImageController@index')->name('boardinghouseimage.index');
    Route::get('boardinghouseimage/create/{boardinghouse}', 'BoardingHouseImageController@create')->name('boardinghouseimage.create');
    Route::post('boardinghouseimage/store', 'BoardingHouseImageController@store')->name('boardinghouseimage.store');
    Route::get('boardinghouseimage/edit/{boardinghouseimage}/{boardinghouse}', 'BoardingHouseImageController@edit')->name('boardinghouseimage.edit');
    Route::put('boardinghouseimage/update/{boardinghouseimage}', 'BoardingHouseImageController@update')->name('boardinghouseimage.update');
    Route::delete('boardinghouseimage/delete/{boardinghouseimage}/{boardinghouse}', 'BoardingHouseImageController@destroy')->name('boardinghouseimage.destroy');
    //kamar kos
    Route::get('boardinghouseroom/{boardinghouse}', 'BoardingRoomController@index')->name('boardinghouseroom.index');
    Route::get('boardinghouseroom/create/{boardinghouse}', 'BoardingRoomController@create')->name('boardinghouseroom.create');
    Route::post('boardinghouseroom/store', 'BoardingRoomController@store')->name('boardinghouseroom.store');
    Route::get('boardinghouseroom/edit/{boardinghouseroom}/{boardinghouse}', 'BoardingRoomController@edit')->name('boardinghouseroom.edit');
    Route::put('boardinghouseroom/update/{boardinghouseroom}', 'BoardingRoomController@update')->name('boardinghouseroom.update');
    Route::delete('boardinghouseroom/delete/{boardinghouseroom}/{boardinghouse}', 'BoardingRoomController@destroy')->name('boardinghouseroom.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'AuthController@login');
    Route::post('login', 'AuthController@authenticate')->name('login');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/storeuser', 'AuthController@storeUser')->name('auth.store');
});


