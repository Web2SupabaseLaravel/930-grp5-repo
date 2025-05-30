<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\LessonController;

Route::resource('lesson', LessonController::class);
Route::resource('dataEnrollments', EnrollmentsController::class);
Route::resource('dataQuizzes', QuizzesController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('payments', PaymentController::class);
});
Route::resource('courses', CourseController ::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
