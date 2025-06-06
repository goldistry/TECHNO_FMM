<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorFinderController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TestimonialController;

Route::get('/chatbot', [MajorFinderController::class, 'index'])->name('chatbot.index');
Route::get('/', function () {return view('homepage');})->name('homepage');
Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

