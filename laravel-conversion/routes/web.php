<?php

use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\CommentController;
use App\Http\Controllers\Student\CommunityController;
use App\Http\Controllers\Student\CvController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\HomepageController;
use App\Http\Controllers\Student\JobsController;
use App\Http\Controllers\Student\PostController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\ProfileSaveController;
use App\Http\Controllers\Student\ViewProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('student.homepage'));

Route::prefix('student')->name('student.')->group(function () {
	Route::get('/homepage', [HomepageController::class, 'show'])->name('homepage');

	Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
	Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
	Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

	Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
	Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
	Route::post('/profile/save', [ProfileSaveController::class, 'store'])->name('profile.save');
	Route::get('/jobs', [JobsController::class, 'show'])->name('jobs');
	Route::get('/community', [CommunityController::class, 'show'])->name('community');
	Route::post('/post', [PostController::class, 'store'])->name('post.store');
	Route::post('/post/{postId}/update', [PostController::class, 'update'])->name('post.update');
	Route::post('/post/{postId}/delete', [PostController::class, 'destroy'])->name('post.delete');
	Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
	Route::get('/cv', [CvController::class, 'show'])->name('cv');
	Route::get('/view-profile', [ViewProfileController::class, 'show'])->name('view_profile');
});
