<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;

Route::resource('reviews', ReviewController::class);
Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('notifications', [NotificationController::class, 'store'])->name('notifications.store');
Route::get('notifications/{notifications}', [NotificationController::class, 'show'])->name('notifications.show');
Route::get('notifications/{notifications}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
Route::put('notifications/{notifications}', [NotificationController::class, 'update'])->name('notifications.update');
Route::delete('notifications/{notifications}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
Route::resource('lesson', LessonController::class);
Route::resource('dataEnrollments', EnrollmentsController::class);
Route::resource('certificates', CertificateController::class);
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
Route::resource('dataQuizzes', QuizzesController::class);
Route::resource('courses', CourseController ::class);
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('payments', PaymentController::class);
    Route::get('/courses/enrolled', [CourseController::class, 'enrolled'])->name('courses.enrolled');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('reports', ReportController::class);


require __DIR__.'/auth.php';
