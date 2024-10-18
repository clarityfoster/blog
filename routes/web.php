<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleShareController;

Route::get('/', [ArticleController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);
Route::get("/articles/delete/{id}", [ArticleController::class, 'delete']);
Route::get("/articles/add", [ArticleController::class, 'add'])->middleware('auth');
Route::post("/articles/add", [ArticleController::class, 'create']);
Route::get("/articles/edit/{id}", [ArticleController::class, 'edit']);
Route::post("/articles/edit/{id}", [ArticleController::class, 'update']);
Route::get("/articles/article-photo/{id}/{imageIndex}", [ArticleController::class, 'articlePhoto'])->name('articles.photo');
Route::get("/users/profile/show-articles/{id}", [ArticleController::class, 'showArticles']);

Route::get("/comments/delete/{id}", [CommentController::class, 'delete']);
Route::post("/comments/add", [CommentController::class, 'add']);
Route::get("/comments/view/{id}", [CommentController::class, 'view']);

Route::post("/comments/reply", [CommentController::class, 'reply']);
Route::get("/comments/reply/delete/{id}", [CommentController::class, 'replyDelete']);

Route::post("/reacts/like", [ReactController::class, 'like']);
Route::post("/reacts/unlike/{id}", [ReactController::class, 'unlike']);
Route::get("/reacts/view/{id}", [ReactController::class, 'likeList']);

Route::get("/users/profile/{id}", [ProfileController::class, 'profile'])->name("profile");
Route::get("/users/profile/edit/{id}", [ProfileController::class, 'edit']);
Route::post("/users/profile/edit/{id}", [ProfileController::class, 'update']);
Route::get("/users/profile/edit-bio/{id}", [ProfileController::class, 'editBio']);
Route::post("/users/profile/edit-bio/{id}", [ProfileController::class, 'updateBio']);
Route::get("/users/profile/indicate/{id}", [ProfileController::class, 'indicators']);
Route::get("/users/profile/upload-profile/{id}", [ProfileController::class, 'uploadProfile']);
Route::post("/users/profile/upload-profile/{id}", [ProfileController::class, 'createProfileImg']);
Route::get("/users/profile/upload-cover/{id}", [ProfileController::class, 'uploadCover']);
Route::post("/users/profile/upload-cover/{id}", [ProfileController::class, 'createCoverImg']);
Route::get("/users/profile/profile-photo/{id}", [ProfileController::class, 'profilePhoto']);
Route::get("/users/profile/cover-photo/{id}", [ProfileController::class, 'coverPhoto']);
Route::get("/users/profile/show-articles/{id}", [ProfileController::class, 'showArticles']);

Route::post("/users/profile/follow/{id}", [FollowController::class, 'follow']);
Route::post("/users/profile/unfollow/{id}", [FollowController::class, 'unfollow']);
Route::get("/users/profile/followers/{id}", [FollowController::class, 'followersList']);
Route::get("/users/profile/following/{id}", [FollowController::class, 'followingList']);

Route::get("/users/search", [SearchController::class, 'search']);

Route::get("/users/users-list", [ProfileController::class, 'usersList']);
Route::get("/dashboard", [ProfileController::class, 'dashborad'])->name('dashboard');
Route::put("/dashboard/changeRole/{id}", [ProfileController::class, 'changeRole'])->name('changeRole');
Route::post("/dashboard/ban/{id}", [ProfileController::class, 'ban'])->name('ban');
Route::post("/dashboard/unban/{id}", [ProfileController::class, 'unban'])->name('unban');

Route::post('/articles/share', [ArticleShareController::class, 'share']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
