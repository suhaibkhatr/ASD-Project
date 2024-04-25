<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorehouseController;

Route::group(
    [
        "middleware" => "auth:api",
        "prefix" => "auth",
    ],
    function ($router) {
        Route::get("logout", [AuthController::class, "logout"]);
        Route::get("refresh", [AuthController::class, "refresh"]);
        Route::get("me", [AuthController::class, "me"]);
    }
);

Route::group(
    [
        "prefix" => "auth",
    ],
    function ($router) {
        Route::post("login", [AuthController::class, "login"]);
        Route::post("register", [AuthController::class, "register"]);
    }
);

Route::group(
    [
        "middleware" => "auth:api",
    ],
    function ($router) {
        Route::apiResource("storehouse", StorehouseController::class);
    }
);
