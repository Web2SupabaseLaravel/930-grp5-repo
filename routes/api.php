<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EnrollmentsApiController;
use App\Http\Controllers\API\QuizzesApiController;


Route::get('/quizzes', [QuizzesApiController::class, 'index']);
Route::get('/quizzes/create', [QuizzesApiController::class, 'create']);
Route::post('/quizzes', [QuizzesApiController::class, 'store']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
