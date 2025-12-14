<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

############################################################################
#### Rotas públicas (não autenticadas)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

############################################################################
#### Rotas protegidas (Sanctum)
Route::middleware('auth:sanctum', 'abilities:auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);
});
