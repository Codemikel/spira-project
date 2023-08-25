<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController as UserV1;

// V1
Route::post('login', 
    [App\Http\Controllers\Api\LoginController::class, 
    'login'
]);

Route::apiResource('v1/user', UserV1::class)
    ->only(['index', 'show', 'destroy', 'store'])
    ->middleware(['auth:sanctum', 'role:admin']);

Route::middleware(['auth', 'role:student'])->group(function () {
    // Rutas protegidas para estudiantes
});

