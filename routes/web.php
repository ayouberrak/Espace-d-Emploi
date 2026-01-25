<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecruiterController;

// Main Dashboard
Route::get('/', [UserController::class, 'index'])->name('dashboard');

// New Platform Sections
Route::get('/stages', [UserController::class, 'stages'])->name('stages');
Route::get('/recruteurs', [UserController::class, 'recrutement'])->name('recrutement');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Profile
Route::get('/profile/{id?}', [UserController::class, 'profile'])->name('profile');

// Espace Recruteur
Route::get('/recruiter/dashboard', [RecruiterController::class, 'dashboard'])->name('recruiter.dashboard');
Route::get('/recruiter/jobs/create', [RecruiterController::class, 'createJob'])->name('recruiter.jobs.create');
Route::post('/recruiter/jobs/store', [RecruiterController::class, 'storeJob'])->name('recruiter.jobs.store');

// Social & Chat
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
Route::get('/network', [App\Http\Controllers\NetworkController::class, 'index'])->name('network.index');
