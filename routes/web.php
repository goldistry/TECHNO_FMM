<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorFinderController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;

// Main Routes
Route::get('/chatbot', [MajorFinderController::class, 'index'])->name('chatbot.index');
Route::get('/', function () {
    return view('homepage');
})->name('homepage');
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors.index');
Route::get('/jurusan/{id}', [MajorController::class, 'show'])->name('majors.show');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// Forum Routes - Simplified version without user authentication
Route::prefix('forum')->group(function () {
    // Discussion routes
    Route::get('/', [DiscussionController::class, 'index'])->name('forum.index');
    Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussions.show');
    
    // Like functionality
    Route::post('/discussions/{discussion}/like', [DiscussionController::class, 'toggleLike'])->name('discussions.like');
    
    // Comment functionality
    Route::post('/discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike'])->name('comments.like');
    
    // Category filter
    Route::get('/category/{category}', [DiscussionController::class, 'byCategory'])->name('forum.category');
});