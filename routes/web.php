<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/posts/{category_id}', [PostController::class, 'getAllPosts']);
Route::get('/posts/{post_id}', [PostController::class, 'getOneFull']);
Route::get('/posts/query?query={query}', [PostController::class, 'getFindQuery'])->name('search');

//Роуты доступыне для админа
Route::middleware(\App\Http\Middleware\AdminCheckMiddleware::class)->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('getAllUsers');
    Route::get('/users/{user_id}', [UserController::class, 'getOneFull'])->name('getOneUser');
    Route::delete('/users/{user_id}', [UserController::class, 'deleteOne'])->name('deleteOneUser');

    Route::post('/posts', [PostController::class, 'createPost'])->name('createPost');
    Route::get('/posts/{post_id}/update', [PostController::class, 'edit'])->name('updatePostPage');
    Route::put('/posts/{post_id}/update', [PostController::class, 'update'])->name('updatePost');
    Route::delete('/posts/{post_id}', [PostController::class, 'delete']);
});

require __DIR__ . '/auth.php';
