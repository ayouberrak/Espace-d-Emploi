<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\recruteuController;
use App\Http\Controllers\offresController;
use App\Http\Controllers\inviController;

Route::get('/', [UserController::class, 'index'])->name('dashboard');

Route::get('/offres', [offresController::class, 'offres'])->name('offres');
Route::get('/recruteurs', [recruteuController::class, 'recrutement'])->name('recrutement');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/login' , [AuthController::class , 'login'])->name('loginPost');
Route::post('/register' ,[AuthController::class , 'store'])->name('registerPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile/{id?}', [ProfileController::class, 'profile'])->name('profile');


Route::post('/invi/{id?}', [inviController::class, 'store'])->name('inviStore');


Route::get('/recruiter/dashboard', [RecruiterController::class, 'dashboard'])->name('recruiter.dashboard');
Route::get('/recruiter/jobs/create', [RecruiterController::class, 'createJob'])->name('recruiter.jobs.create');
Route::post('/recruiter/jobs/store', [RecruiterController::class, 'storeJob'])->name('recruiter.jobs.store');

Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');

Route::get('/network', [App\Http\Controllers\inviController::class, 'showInvi'])->name('networkIndex');
Route::post('/network/accept/{id?}',[inviController::class,'acceptInvi'])->name('acceptInvi');
