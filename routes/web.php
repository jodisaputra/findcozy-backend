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
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'AuthController@login');
    Route::post('login', 'AuthController@authenticate')->name('login');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/storeuser', 'AuthController@storeUser')->name('auth.store');
});


