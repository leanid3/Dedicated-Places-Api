<?php
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return json_encode($request->user());
});

//admin
require __DIR__ . '/API/admin.php';
//user
require __DIR__ . '/API/user.php';
//public
require __DIR__ . '/API/public.php';

