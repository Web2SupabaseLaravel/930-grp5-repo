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
Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('notification/create', [NotificationController::class, 'create'])->name('notification.create');
Route::post('notification', [NotificationController::class, 'store'])->name('notification.store');
Route::get('notification/{notification}', [NotificationController::class, 'show'])->name('notification.show');
Route::get('notification/{notification}/edit', [NotificationController::class, 'edit'])->name('notification.edit');
Route::put('notification/{notification}', [NotificationController::class, 'update'])->name('notification.update');
Route::delete('notification/{notification}', [NotificationController::class, 'destroy'])->name('notification.destroy');



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
