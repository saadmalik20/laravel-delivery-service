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

## Login and logout Routes
Route::get('/', [\App\Http\Controllers\WEB\LoginController::class, 'LoginForm'])->name('login');

## Sender Route
Route::get('/sender', '\App\Http\Controllers\WEB\UserController@sender')->name('sender');

## Biker Route
Route::get('/biker', '\App\Http\Controllers\WEB\UserController@biker')->name('biker');
Route::get('/parcels', '\App\Http\Controllers\WEB\ParcelController@myParcels')->name('parcels');
Route::get('/parcels/{parcel}', '\App\Http\Controllers\WEB\ParcelController@editParcel')->name('parcel.status');


