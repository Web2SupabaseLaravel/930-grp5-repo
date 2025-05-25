<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;


Route::resource('reviews', ReviewController::class);


Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('notification/create', [NotificationController::class, 'create'])->name('notification.create');
Route::post('notification', [NotificationController::class, 'store'])->name('notification.store');
Route::get('notification/{notification}', [NotificationController::class, 'show'])->name('notification.show');
Route::get('notification/{notification}/edit', [NotificationController::class, 'edit'])->name('notification.edit');
Route::put('notification/{notification}', [NotificationController::class, 'update'])->name('notification.update');
Route::delete('notification/{notification}', [NotificationController::class, 'destroy'])->name('notification.destroy');


Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);


Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/home', [HomeController::class, 'index'])->name('home');
