<?php

use App\Http\Controllers\Main\AuthController;
use App\Http\Controllers\Main\TenantConfigurationController;
use App\Http\Controllers\Main\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware('user_type:main')
        ->group(function () {
            Route::resource('tenant', TenantController::class);
        });

    Route::middleware('user_type:tenant', 'connect_tenant')
        ->group(function () {
            Route::controller(TenantConfigurationController::class)->group(function () {
                Route::put('tenant_configuration', 'update');
            });
        });
});
