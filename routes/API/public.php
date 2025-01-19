<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->middleware('guest')->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);
    Route::get("/posts", [PostController::class, "index"]);
    Route::get("/posts/{post}", [PostController::class, "show"]);
    Route::get("/category", [CategoryController::class, "index"]);
    Route::get("/category/{category}", [CategoryController::class, "show"]);
//    Route::get("/tag/category/{tag}", [TagController::class, "index"]);
//    Route::get('/tag/{category}/{post}/{tag}', [TagController::class, "show"]);
});
