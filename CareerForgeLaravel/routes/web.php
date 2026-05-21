<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CVController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index']);

Route::post('/profile/update', [ProfileController::class, 'update']);

Route::get('/jobs', [JobsController::class, 'index']);

Route::get('/community', [CommunityController::class, 'index']);

Route::get('/quizzes', [QuizController::class, 'index']);

Route::get('/quiz/{id}', [QuizController::class, 'start']);

Route::post('/quiz/submit/{id}', [QuizController::class, 'submit']);

Route::get('/cv', [CVController::class, 'view']);

Route::get('/cv/download', [CVController::class, 'download']);