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

Route::middleware(['auth:sanctum', 'token.expiration', 'set.enterprise'])->group(function () {

    Route::apiResource('department', DepartmentController::class)
        ->parameters(['department' => 'departmentId']);

    Route::apiResource('color', ColorController::class)
        ->parameters(['color' => 'colorID']);

    Route::prefix('grid')->group(function () {
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

    Route::apiResource('supplier.category', CategorySupplierController::class)
        ->shallow()
        ->parameters(['category' => 'categoryId']);

    Route::apiResource('supplier.catalog', CatalogSupplierController::class)
        ->shallow()
        ->parameters(['catalog' => 'catalogId']);

    Route::apiResource('supplier', SupplierController::class)
        ->parameters(['supplier' => 'supplierId']);

    Route::post('supplier/filter', [SupplierController::class, 'filter']);

    Route::apiResource('user', UserController::class)
        ->parameters(['user' => 'userId']);

    Route::post('user/filter', [UserController::class, 'filter']);

    Route::apiResource('client', ClientController::class)
        ->parameters(['client' => 'clientId']);

    Route::post('client/filter', [ClientController::class, 'filter']);

    Route::apiResource('employee', EmployeeController::class)
        ->parameters(['employee' => 'employeeId']);

    Route::post('employee/filter', [EmployeeController::class, 'filter']);

    Route::prefix('employee/action')->group(function () {
        Route::post('create-access-login', [EmployeeController::class, 'createAccessLogin']);
        Route::post('remove-access-login', [EmployeeController::class, 'removeAccessLogin']);
    });

    Route::get('role/list-select', [RoleController::class, 'indexSelect']);
});
