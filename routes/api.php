<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RevenueController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/reset', [UserController::class, 'reset']);
Route::post('/verify', [UserController::class, 'verify']);
Route::post('/newPassword', [UserController::class, 'newPassword']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/', [CategoryController::class, 'update']);
        Route::delete('/{categoryID}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('revenue')->group(function () {
        Route::get('/', [RevenueController::class, 'index']);
        Route::get('/{revenueID}', [RevenueController::class, 'show']);
        Route::post('/', [RevenueController::class, 'store']);
        Route::put('/', [RevenueController::class, 'update']);
        Route::put('/favorite/{revenueID}', [RevenueController::class, 'favorite']);
        Route::delete('/{revenueID}', [RevenueController::class, 'destroy']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'show']);
        Route::post('/update-data', [UserController::class, 'updateData']);
        Route::put('/update-password', [UserController::class, 'updatePassword']);
        Route::delete('/{userID}', [UserController::class, 'destroy']);
    });
});
