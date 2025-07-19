<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicPostController;


Route::get('/', [PublicPostController::class, 'index'])->name('public.welcome');


Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/admin', function () {
    return view('admin');
});



Route::get('/posts', [PostController::class, 'index'])->name('posts.index');           // All posts
Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my');         // User's own posts
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');   // Form
Route::post('/post', [PostController::class, 'store'])->name('posts.store');           // Save post
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');         // Detail page
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');    // Edit form
Route::put('/post/{id}', [PostController::class, 'update'])->name('posts.update');     // Update
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('posts.destroy'); // Delete


Route::get('/admin/users', [AdminController::class, 'userList'])->name('admin.users');
Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

Route::get('/welcome', [PublicPostController::class, 'index'])->name('public.welcome');
Route::get('/welcome/post/{id}', [PublicPostController::class, 'show'])->name('public.post.show');


Route::post('/upload-image', [App\Http\Controllers\PostController::class, 'uploadImage']);
