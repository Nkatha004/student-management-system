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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mpesa/password', 'App\Http\Controllers\PaymentsController@lipaNaMpesaPassword');
Route::post('/mpesa/new/access/token','App\Http\Controllers\PaymentsController@newAccessToken');
Route::post('/mpesa/stk/push', 'App\Http\Controllers\PaymentsController@stkPush')->name('lipa');
Route::post('/stk/push/callback/url', 'App\Http\Controllers\PaymentsController@mpesaResponse');