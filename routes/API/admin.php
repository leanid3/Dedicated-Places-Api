<?php

use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->middleware(['throttle:api', 'auth:sanctum', AdminCheckMiddleware::class])->group(function () {
    Route::apiResource('posts', PostController::class)->except(['index', 'show']);
    Route::apiResource('category', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('users', UserController::class);
});
