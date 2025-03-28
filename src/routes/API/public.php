<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\v1\TagController;
use Illuminate\Support\Facades\Route;
//public route
Route::prefix('/v1/')->group(function () {
    
    //auth
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    //posts
    Route::get("/posts", [PostController::class, "index"])->name("posts.index");
    Route::get("/posts/{post}", [PostController::class, "show"])->name("posts.show");

    //comments
    Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'show']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);

    //categories
    Route::get("/category", [CategoryController::class, "index"])->name("category.index");
    Route::get("/category/{category}", [CategoryController::class, "show"])->name("category.show");

    //more
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
});
