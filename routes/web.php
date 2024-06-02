<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;
use App\Models\Students;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('users', UsersController::class);
Route::resource('students', StudentsController::class);

