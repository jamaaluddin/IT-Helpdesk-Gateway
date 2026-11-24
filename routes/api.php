<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AssetController;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    // Ticket API
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/{id}', [TicketController::class, 'show']);

    // Asset API
    Route::get('/assets', [AssetController::class, 'index']);
    Route::get('/assets/{id}', [AssetController::class, 'show']);

});
