<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PerformanceController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// LOGIN PAGE
Route::get('/login', [

    AuthController::class,
    'showLogin'

]);

// LOGIN FUNCTION
Route::post('/login', [

    AuthController::class,
    'login'

]);

// REGISTER PAGE
Route::get('/register', [

    AuthController::class,
    'showRegister'

]);

// REGISTER FUNCTION
Route::post('/register', [

    AuthController::class,
    'register'

]);

// LOGOUT
Route::get('/logout', [

    AuthController::class,
    'logout'

]);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([])->group(function () {

    // DASHBOARD
    Route::get('/', [

        DashboardController::class,
        'index'

    ]);

    // PROFILE
    Route::get('/profile', [

        ProfileController::class,
        'index'

    ]);

    Route::post('/profile/update', [

        ProfileController::class,
        'update'

    ]);

    // JOBS
    Route::get('/jobs', [

        JobsController::class,
        'index'

    ]);

    // COMMUNITY
    Route::get('/community', [

        CommunityController::class,
        'index'

    ]);

    // QUIZZES
    Route::get('/quizzes', [

        QuizController::class,
        'index'

    ]);

    Route::get('/quiz/{id}', [

        QuizController::class,
        'start'

    ]);

    Route::post('/quiz/submit/{id}', [

        QuizController::class,
        'submit'

    ]);

    // EVENTS
    Route::get('/events', [

        EventController::class,
        'index'

    ]);

    Route::post('/events/add', [

        EventController::class,
        'store'

    ]);

    // CV
    Route::get('/cv', [

        CVController::class,
        'view'

    ]);

    Route::get('/cv/download', [

        CVController::class,
        'download'

    ]);

    // PERFORMANCE
    Route::get('/performance', [

        PerformanceController::class,
        'index'

    ]);

    // DOWNLOAD PERFORMANCE REPORT PDF
    Route::get('/download-performance-report', [

        PerformanceController::class,
        'downloadPdf'

    ]);

});
