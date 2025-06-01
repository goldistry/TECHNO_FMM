<?php

use App\Http\Controllers\AIChatbotController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//   return view('welcome');
// });




Route::middleware('auth')->group(function () {
  Route::get('/', function () {
    return view('homepage');
  })->name('homepage');
  Route::get('/chatbot', [AIChatbotController::class, 'index'])->middleware(['auth', 'verified'])->name('chatbot.index');


  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Tampilkan halaman utama chatbot
  Route::get('/ai-mate', [AIChatbotController::class, 'index'])->name('ai.mate.index')->middleware('auth'); // Pastikan user login

  // Endpoint untuk mendapatkan summary kategori dari AI
  Route::post('/ai-mate/category-summary', [AIChatbotController::class, 'getCategorySummary'])->name('ai.mate.categorySummary');

  // Endpoint untuk mendapatkan summary keseluruhan dari AI
  Route::post('/ai-mate/overall-summary', [AIChatbotController::class, 'getOverallSummary'])->name('ai.mate.overallSummary');
});

require __DIR__ . '/auth.php';
