<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/post',  [PostController::class, 'store']);
    Route::prefix('/posts')->group(function(){
        
        Route::get('', [PostController::class, 'index']);
        Route::post('/{post}/comment', [CommentController::class, 'store']);//comment a post
        Route::post('/{post}/like', [LikeController::class, 'store']);//post likes
        Route::post('/{post}/comment/{comment}/reply',
        [CommentReplyController::class, 'store']);//reply a comment
        Route::get('/replies/{id}', [CommentReplyController::class, 'index']);
        Route::Post('/{post}/comment/{comment}/like', 
        [LikeController::class, 'commentLike']);//like comment

    });
    

});

