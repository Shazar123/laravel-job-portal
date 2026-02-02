<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

// Public routes
Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// User routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('my.applications');
});

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/jobs', [JobController::class, 'adminIndex'])->name('admin.jobs');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('admin.jobs.store');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::get('/jobs/{job}/applications', [ApplicationController::class, 'viewApplicants'])->name('admin.applications');
    Route::post('/applications/{application}', [ApplicationController::class, 'updateStatus'])->name('admin.applications.update');
});
