<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'auth'

], function ($router) {

    Route::get('logout', [AuthController::class , 'logout']);
    Route::get('refresh', [AuthController::class , 'refresh']);
    Route::get('me', [AuthController::class , 'me']);

});


Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class , 'login']);
    Route::post('register', [AuthController::class , 'register']);
});