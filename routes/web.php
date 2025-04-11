<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorFinderController;

Route::get('/', [MajorFinderController::class, 'index'])->name('chatbot.index');