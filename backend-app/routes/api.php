
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonApiController;

Route::get('/lessons', [LessonApiController::class, 'index']);
Route::post('/lessons', [LessonApiController::class, 'store']);
Route::get('/lessons/{id}', [LessonApiController::class, 'show']);
Route::put('/lessons/{id}', [LessonApiController::class, 'update']);
Route::delete('/lessons/{id}', [LessonApiController::class, 'destroy']);
