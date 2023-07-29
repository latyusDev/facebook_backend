<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
        return view('home');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login');
});

Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');
// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// posts
Route::controller(PostController::class)
->group(function()
{
    // display
    Route::get('/posts',  'index')->name('posts');
    // store
    Route::post('/posts',  'store');
    // show
    Route::get('/posts/{post}',  'show')->name('posts.show');
    // delete
    Route::delete('/delete/{post}',  'destroy')->name('destroy');
});


// likes

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/unlikes', [PostLikeController::class, 'destroy'])->name('posts.unlikes');

// show

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
