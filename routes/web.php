<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
Route::get('/', function () {
    $posts = Post::all();
    return view('welcome', ['posts' => $posts]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', CheckUserRole::class . ':admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/subscriptions/{subscription}/subscribe', [SubscriptionsController::class, 'subscribe'])->name('subscriptions.subscribe');
Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('subscriptions.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth', CheckUserRole::class . ':admin');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth', CheckUserRole::class . ':admin');
// toutes les routes publiques par défaut
Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// route pour créer un post protégée par l'authentification et le rôle admin

require __DIR__.'/auth.php';
