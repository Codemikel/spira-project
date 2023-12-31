<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController as UserV1;
use App\Http\Controllers\Api\v1\CourseController as CourseV1;
use App\Http\Controllers\Api\v1\ClassroomController as ClassroomV1;
use App\Http\Controllers\Api\v1\StudentController as StudentV1;

// V1
Route::post('login', 
    [App\Http\Controllers\Api\LoginController::class, 
    'login'
]);

Route::apiResource('v1/user', UserV1::class)
    ->only(['index', 'show', 'destroy', 'store', 'update'])
    ->middleware(['auth:sanctum', 'role:admin']);

Route::apiResource('v1/course', CourseV1::class)
    ->only(['index', 'show', 'destroy', 'store', 'update'])
    ->middleware(['auth:sanctum', 'role:admin']);

Route::apiResource('v1/class', ClassroomV1::class)
    ->only(['index', 'show', 'destroy', 'store', 'update'])
    ->middleware(['auth:sanctum', 'role:admin']);

Route::apiResource('v1/student', StudentV1::class)
    ->only(['index', 'show'])
    ->middleware(['auth:sanctum']);