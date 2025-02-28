<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendRequestController;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/users', function () {
//    return view('users');
//})->name('users');

Route::get('/users',[ProfileController::class,'show'])->name('users')->middleware('auth');
Route::get('/users/search', [MemberController::class, 'search'])->name('members.search');
Route::post('users/send_request/{user_id}', [FriendRequestController::class, 'send_request'])->name('send_request');
Route::get('/users/{user}', [MemberController::class, 'show'])->name('users.show');
Route::get('/requests', [FriendRequestController::class, 'show_requests'])->name('show_requests');
Route::post('/requests/accept/{user_id}', [FriendRequestController::class, 'accept_request'])->name('accept_request');
Route::post('/request/reject/{user_id}', [FriendRequestController::class, 'reject_request'])->name('reject_request');
Route::get('/friends', [FriendsController::class, 'show_friends'])->name('show_friends');
Route::post('/dashboard', [PostController::class, 'createPost'])->name('create_post');
Route::get('/dashboard',[DashboardController::class , 'index'])->name('dashboard');
Route::post('/posts/{post}/like', [LikeController::class, 'storeLikes'])->name('posts.like')->middleware('auth');
Route::post('/posts/{post}/comments', [CommentController::class, 'storeComment'])->name('comments.store');


Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
