<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('users', UsersController::class);

