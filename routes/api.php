<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ReviewApiController;
use App\Http\Controllers\API\NotificationApiController;

Route::apiResource('reviews', ReviewApiController::class);
Route::apiResource('notifications',NotificationApiController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
