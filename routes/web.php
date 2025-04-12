<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorFinderController;
use App\Http\Controllers\MajorController;

Route::get('/', [MajorFinderController::class, 'index'])->name('chatbot.index');
Route::get('/home', function () {return view('homepage');});
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors.index');
Route::get('/jurusan/{id}', [MajorController::class, 'show'])->name('majors.show');

