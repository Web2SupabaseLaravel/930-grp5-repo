<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('certificates', CertificateController::class);

// راوتات wishlist بدون حماية middleware auth
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "اتصال قاعدة البيانات ناجح 👍";
    } catch (\Exception $e) {
        return "فشل الاتصال: " . $e->getMessage();
    }
});

Route::get('/test-route', function () {
    return '<h1>نجح اختبار الراوت والسيرفر</h1>';
});

require __DIR__.'/auth.php';
