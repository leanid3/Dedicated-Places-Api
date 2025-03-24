<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CommentController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth:sanctum'])->prefix('/v1/')->group(function () {
    Route::get('/user', [AuthController::class, "profile"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::post('/reset-password', [NewPasswordController::class, 'store']);
    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class);
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store']);
    Route::apiResource('comment', CommentController::class)->except(['index', 'show']);
});
