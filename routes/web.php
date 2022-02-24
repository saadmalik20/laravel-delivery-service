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
Route::get('/sender', '\App\Http\Controllers\WEB\ParcelController@senderDashboard')->name('sender');

## Biker Route
Route::get('/biker', '\App\Http\Controllers\WEB\ParcelController@bikerDashboard')->name('biker');

##Parcels Routes
Route::get('/parcel/pick/{id}', '\App\Http\Controllers\WEB\ParcelController@pickup')->name('parcel.pickup');
//Route::get('/parcel/{id}', '\App\Http\Controllers\WEB\ParcelController@detail')->name('parcel.detail');

Route::get('/parcel/create', '\App\Http\Controllers\WEB\ParcelController@create')->name('parcel.create');

Route::get('/parcel/{id}', '\App\Http\Controllers\WEB\ParcelController@edit')->name('parcel.edit');


