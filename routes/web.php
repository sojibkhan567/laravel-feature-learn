<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::post('/store-media', [MediaController::class, 'store'])->name('media.store');
# gallery 
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::delete('/gallery/{media}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

// Post Controller route
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'store']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/delete/{id}', [UserController::class, 'destory'])->name('users.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
