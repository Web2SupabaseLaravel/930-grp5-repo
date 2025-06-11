<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ReviewApiController;
use App\Http\Controllers\API\NotificationApiController;
use App\Http\Controllers\API\CourseApiController;

Route::apiResource('reviews', ReviewApiController::class);
Route::apiResource('notifications',NotificationApiController::class);
Route::apiResource('courses', CourseApiController::class);
Route::get('stats', [CourseApiController::class, 'stats']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
