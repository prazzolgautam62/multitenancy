<?php

use App\Http\Controllers\Main\AuthController;
use App\Http\Controllers\Main\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('user_type:main')
        ->group(function () {
            Route::resource('tenant', TenantController::class);
        });
});
