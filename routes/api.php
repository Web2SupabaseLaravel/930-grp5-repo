<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ReportApiController;

Route::middleware('verify.supabase.jwt')->group(function () {
    Route::apiResource('reports', ReportApiController::class)->names([
        'index' => 'api.reports.index',
        'show' => 'api.reports.show',
        'store' => 'api.reports.store',
        'update' => 'api.reports.update',
        'destroy' => 'api.reports.destroy',
    ]);
});

