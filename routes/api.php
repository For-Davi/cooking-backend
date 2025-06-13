<?php

use App\Http\Controllers\CatalogSupplierController;
use App\Http\Controllers\CategorySupplierController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::prefix('department')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [DepartmentController::class, 'index']);
    Route::post('/', [DepartmentController::class, 'store']);
    Route::put('/', [DepartmentController::class, 'update']);
    Route::delete('/{departmentId}', [DepartmentController::class, 'destroy']);
});

Route::prefix('supplier')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', [CategorySupplierController::class, 'index']);
        Route::get('/{categoryId}', [CategorySupplierController::class, 'show']);
        Route::post('/', [CategorySupplierController::class, 'store']);
        Route::put('/', [CategorySupplierController::class, 'update']);
        Route::delete('/{categoryId}', [CategorySupplierController::class, 'destroy']);
    });

    Route::prefix('catalog')->group(function () {
        Route::get('/', [CatalogSupplierController::class, 'index']);
        Route::get('/{catalogId}', [CatalogSupplierController::class, 'show']);
        Route::post('/', [CatalogSupplierController::class, 'store']);
        Route::put('/', [CatalogSupplierController::class, 'update']);
        Route::delete('/{catalogId}', [CatalogSupplierController::class, 'destroy']);
    });

    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/{supplierId}', [SupplierController::class, 'show']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::post('/filter', [SupplierController::class, 'filter']);
    Route::put('/', [SupplierController::class, 'update']);
    Route::delete('/{supplierId}', [SupplierController::class, 'destroy']);
});

Route::prefix('user')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::post('/filter', [UserController::class, 'filter']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/{userId}', [UserController::class, 'destroy']);
});

Route::prefix('role')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/list-select', [RoleController::class, 'indexSelect']);
});
