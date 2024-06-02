<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ClassCashFundController;


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('users', UsersController::class);

Route::resource('students', StudentsController::class);
Route::post('students/{student}/attendance', [StudentsController::class, 'absen'])->name('students.absen');
Route::get('students/{student}/attendance/show', [StudentsController::class, 'showAbsensi'])->name('students.showAbsensi');

Route::resource('attendance', AttendanceController::class);

Route::resource('classCashFund', ClassCashFundController::class);

