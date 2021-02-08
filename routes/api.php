<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/post/{post:id}', [App\Http\Controllers\ApiController::class, 'get_post']);
    Route::get('/post/{post:id}/comments', [App\Http\Controllers\ApiController::class, 'get_post_comments']);
    Route::get('/post/top/{count}', [App\Http\Controllers\ApiController::class, 'get_post_top']);
    Route::get('/comment/{comment:id}', [App\Http\Controllers\ApiController::class, 'get_comment']);
    Route::get('/user/{user:id}', [App\Http\Controllers\ApiController::class, 'get_user']);
    Route::get('/user/top/{count}', [App\Http\Controllers\ApiController::class, 'get_user_top']);
    Route::get('/user/{user:id}/votes', [App\Http\Controllers\ApiController::class, 'get_user_votes']);
});
