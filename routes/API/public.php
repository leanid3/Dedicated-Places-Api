<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->middleware('guest')->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);
    Route::get("/posts", [PostController::class, "index"])->name("posts.index");
    Route::get("/posts/{post}", [PostController::class, "show"])->name("posts.show");
    Route::get("/category", [CategoryController::class, "index"])->name("category.index");
    Route::get("/category/{category}", [CategoryController::class, "show"])->name("category.show");
});
