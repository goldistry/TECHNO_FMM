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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Old simulation routes removed - replaced with direct major selection system
    Route::get('/ai-career-advisor', [AIChatbotController::class, 'index'])->name('ai.mate.index');
    Route::post('/ai-career-advisor/category-summary', [AIChatbotController::class, 'getCategorySummary'])->name('ai.mate.categorySummary');
    Route::post('/ai-career-advisor/overall-summary', [AIChatbotController::class, 'getOverallSummary'])->name('ai.mate.overallSummary');

    // Routes untuk Simulasi (jika diimplementasikan)
    Route::post('/simulation/start', [AIChatbotController::class, 'startSimulation'])->name('simulation.start');
    Route::post('/simulation/submit-answer', [AIChatbotController::class, 'submitSimulationAnswer'])->name('simulation.submitAnswer');
});

require __DIR__ . '/auth.php';
