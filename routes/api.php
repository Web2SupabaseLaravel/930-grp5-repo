<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WishlistApiController;


Route::apiResource('wishlist', WishlistApiController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});