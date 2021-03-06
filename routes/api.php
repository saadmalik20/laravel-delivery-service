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

Route::post('authenticate', [\App\Http\Controllers\API\UserController::class, 'authenticate']);

Route::middleware('auth:api')->group( function () {
    Route::get('logout', [\App\Http\Controllers\API\UserController::class, 'logout']);

    Route::get('parcels', [\App\Http\Controllers\API\ParcelController::class, "index"]);
    Route::get('parcel/{id}', [\App\Http\Controllers\API\ParcelController::class, "show"]);
    Route::post('parcel', [\App\Http\Controllers\API\ParcelController::class, "store"]);
    Route::put('parcel/{id}', [\App\Http\Controllers\API\ParcelController::class, "update"])->middleware(\App\Http\Middleware\bikers::class);
    Route::put('parcel/pick/{id}', [\App\Http\Controllers\API\ParcelController::class, "pickup"])
    ->middleware(\App\Http\Middleware\bikers::class);
});
