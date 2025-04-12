<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
