<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('users', UsersController::class);
Route::resource('students', StudentsController::class);
Route::post('students/{student}/attendance', [StudentsController::class, 'absen'])->name('students.absen');
Route::resource('attendance', AttendanceController::class);

