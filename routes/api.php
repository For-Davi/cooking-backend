<?php

use App\Http\Controllers\CatalogSupplierController;
use App\Http\Controllers\CategorySupplierController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GridController;
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

Route::prefix('color')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [ColorController::class, 'index']);
    Route::post('/', [ColorController::class, 'store']);
    Route::put('/', [ColorController::class, 'update']);
    Route::delete('/{colorID}', [ColorController::class, 'destroy']);
});

Route::prefix('grid')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {

    Route::prefix('item')->group(function () {
        Route::get('/{itemID}', [GridController::class, 'showItem']);
        Route::post('/', [GridController::class, 'storeItem']);
        Route::put('/', [GridController::class, 'updateItem']);
        Route::delete('/{itemID}', [GridController::class, 'destroyItem']);
    });

    Route::get('/', [GridController::class, 'index']);
    Route::get('/get-itens/{gridID}', [GridController::class, 'indexItens']);
    Route::post('/', [GridController::class, 'store']);
    Route::put('/', [GridController::class, 'update']);
    Route::delete('/{gridID}', [GridController::class, 'destroy']);
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

Route::prefix('client')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{clientId}', [ClientController::class, 'show']);
    Route::post('/', [ClientController::class, 'store']);
    Route::post('/filter', [ClientController::class, 'filter']);
    Route::put('/', [ClientController::class, 'update']);
    Route::delete('/{clientId}', [ClientController::class, 'destroy']);
});

Route::prefix('employee')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{employeeId}', [EmployeeController::class, 'show']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::post('/filter', [EmployeeController::class, 'filter']);
    Route::put('/', [EmployeeController::class, 'update']);
    Route::delete('/{employeeId}', [EmployeeController::class, 'destroy']);

    Route::prefix('action')->group(function () {
        Route::post('/create-access-login', [EmployeeController::class, 'createAccessLogin']);
        Route::post('/remove-access-login', [EmployeeController::class, 'removeAccessLogin']);
    });
});

Route::prefix('role')->middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {
    Route::get('/list-select', [RoleController::class, 'indexSelect']);
});
