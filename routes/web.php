<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('training-centers', TrainingCenterController::class);
Route::resource('areas', AreaController::class);
Route::resource('computers', ComputerController::class);
Route::resource('courses', CourseController::class);
Route::resource('apprentices', ApprenticeController::class);
Route::resource('teachers', TeacherController::class);
