<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return json_encode($request->user());
});
Route::prefix('/v1/')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('category', CategoryController::class);
});
