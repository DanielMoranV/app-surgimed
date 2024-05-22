<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InventoryMovementController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\UserRoleController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::get('/unauthorized', [AuthController::class, 'unauthorized']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'roles'
], function () {
    Route::get('/', [UserRoleController::class, 'getRoles']);
    Route::put('/user/role', [UserRoleController::class, 'assignRole']);
    Route::delete('/user/role', [UserRoleController::class, 'removeRole']);
});
