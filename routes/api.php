<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::group(['prefix' => 'twitee/'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {

        //Endpoints for Authentication
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('user-profile', [AuthController::class, 'userProfile']);

        //Endpoints for post
        Route::post('post', [PostController::class, 'create']);
        Route::get('posts', [PostController::class, 'getAll']);
        Route::get('post/{id}', [PostController::class, 'detail']);
        Route::delete('post/{id}', [PostController::class, 'delete']);

        //Endpoints for comment
        Route::post('comment/{post}', [CommentController::class, 'create']);
        Route::delete('comment/{post_id}/{id}', [CommentController::class, 'delete']);
    });
});
