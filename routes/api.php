<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('hoosh')->name('hoosh.')->middleware('hoosh.api.auth')->group(function () {
    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('/{mainQuestion}', [QuestionController::class, 'show'])->name('show');
        Route::post('/{mainQuestion}', [QuestionController::class, 'store'])->name('store');
    });

    Route::get('answers/', [AnswerController::class, 'index'])->name('index');
    Route::post('reviews/', [ReviewController::class, 'store'])->name('store');
});


Route::fallback(function () {
    return sendResponse(message: "Route Not Found", status: 404, error: true);
});
