<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/test-route', function () {
    return 'This is a test route';
});

// Display all registered controllers

//dd(app('router')->getRoutes()->getControllers());

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

// routes/web.php

use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index']);
Route::get('/create-post', [PostController::class, 'create']);
Route::post('/store-post', [PostController::class, 'store'])->name('post.store');
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('user.profile')->middleware('auth');

Route::get('/post/{post}/edit', [ProfileController::class, 'edit'])->name('post.edit');
Route::patch('/post/{post}', [ProfileController::class, 'update'])->name('post.update');
Route::delete('/post/{post}', [ProfileController::class, 'destroy'])->name('post.destroy');
Route::post('/like/{post}', [PostController::class, 'like'])->name('post.like');
Route::get('/test-notification', [PostController::class, 'testNotification']);
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');


use App\Http\Controllers\CommentController;
Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::get('/load-comments/{post}', [CommentController::class, 'loadComments']);
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/delete-comment/{comment}', [CommentController::class, 'destroy']);

use App\Http\Controllers\NotificationController;
Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead']);






Route::get('/home', function () {
    return view('welcome ');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
