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

Route::get('/', 'AuthController@login');
Route::post('login', 'AuthController@authenticate')->name('login');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/storeuser', 'AuthController@storeUser')->name('auth.store');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
