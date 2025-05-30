<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
// Route::post('/reset', [UserController::class, 'reset']);
// Route::post('/verify', [UserController::class, 'verify']);
// Route::post('/newPassword', [UserController::class, 'resetPassword']);

Route::prefix('department')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [DepartmentController::class, 'index']);
    Route::post('/', [DepartmentController::class, 'store']);
    Route::put('/', [DepartmentController::class, 'update']);
    Route::delete('/{id}', [DepartmentController::class, 'destroy']);
});
