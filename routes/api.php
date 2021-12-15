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


//Route::group(['namespace' => 'App\Http\Controllers\Coings', 'prefix' => 'coings'], function () {
//    Route::resource('exchange','ExchangeRateController')->names('exchange');
//    Route::resource('office','OfficeController')->names('office');
//});

Route::group(['namespace' => 'App\Http\Controllers\Coings', 'prefix' => 'coings'], function () {
    Route::resource('exchange','ExchangeRateController')->names('exchange');
    Route::resource('office','OfficeController')->names('office');
});



