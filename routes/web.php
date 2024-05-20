<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;

Route::get('/', [ArticleController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);
Route::get("/articles/delete/{id}", [ArticleController::class, 'delete']);
Route::get("/articles/add", [ArticleController::class, 'add'])->middleware('auth');
Route::post("/articles/add", [ArticleController::class, 'create']);
Route::get("/articles/edit/{id}", [ArticleController::class, 'edit']);
Route::post("/articles/edit/{id}", [ArticleController::class, 'update']);
Route::get("/comments/delete/{id}", [CommentController::class, 'delete']);
Route::post("/comments/add", [CommentController::class, 'add']);
Route::get("/comments/view/{id}", [CommentController::class, 'view']);
Route::post("/reacts/like", [ReactController::class, 'like']);
Route::post("/reacts/unlike/{id}", [ReactController::class, 'unlike']);
Route::get("/reacts/view/{id}", [ReactController::class, 'likeList']);
Route::get("/users/profile/{id}", [ProfileController::class, 'profile'])->name("profile");
Route::get("/users/profile/edit/{id}", [ProfileController::class, 'edit']);
Route::post("/users/profile/edit/{id}", [ProfileController::class, 'update']);
Route::get("/users/profile/edit-bio/{id}", [ProfileController::class, 'editBio']);
Route::post("/users/profile/edit-bio/{id}", [ProfileController::class, 'updateBio']);
Route::post("/users/profile/follow/{id}", [FollowController::class, 'follow']);
Route::post("/users/profile/unfollow/{id}", [FollowController::class, 'unfollow']);
Route::get("/users/profile/followers/{id}", [FollowController::class, 'followersList']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
