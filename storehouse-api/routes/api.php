<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

        Route::get("categories/{storehouse_id}", [
            CategoryController::class,
            "index",
        ]);
        Route::post("categories/{storehouse_id}", [
            CategoryController::class,
            "store",
        ]);
        Route::get("categories/{storehouse_id}/{category_id}", [
            CategoryController::class,
            "show",
        ]);
        Route::put("categories/{storehouse_id}/{category_id}", [
            CategoryController::class,
            "update",
        ]);
        Route::delete("categories/{storehouse_id}/{category_id}", [
            CategoryController::class,
            "destroy",
        ]);

        Route::get("products/{storehouse_id}", [
            ProductController::class,
            "index",
        ]);
        Route::post("products/{storehouse_id}", [
            ProductController::class,
            "store",
        ]);
        Route::get("products/{storehouse_id}/{product_id}", [
            ProductController::class,
            "show",
        ]);
        Route::put("products/{storehouse_id}/{product_id}", [
            ProductController::class,
            "update",
        ]);
        Route::delete("products/{storehouse_id}/{product_id}", [
            ProductController::class,
            "destroy",
        ]);
    }
);
