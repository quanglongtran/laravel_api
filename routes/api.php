<?php

use App\Http\Controllers\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', [API\AuthController::class, 'login']);
    Route::post('register', [API\AuthController::class, 'register']);
    Route::post('logout', [API\AuthController::class, 'logout']);
    Route::post('refresh', [API\AuthController::class, 'refresh']);
    Route::post('profile', [API\UserController::class, 'profile']);

    Route::controller(API\RoleController::class)->prefix('role')->group(function () {
        Route::get('/', 'index')->middleware('can:read role');
        Route::post('/', 'store')->middleware('can:insert role');
        Route::match(['put', 'patch'], '/', 'update')->middleware('can:update role');
        Route::delete('/', 'destroy')->middleware('can:delete role');
        Route::patch('restore', 'restore')->middleware('can:update role');
        Route::post('give-permission-to', 'givePermissionTo')->middleware('can:decentralization');
        Route::post('sync-permission', 'syncPermissions')->middleware('can:decentralization');
        Route::post('revoke-permission-to', 'revokePermissionTo')->middleware('can:decentralization');
    });

    Route::controller(API\PermissionController::class)->prefix('permission')->group(function () {
        Route::get('/', 'index')->middleware('can:read permission');
        Route::post('/', 'store')->middleware('can:insert permission');
        Route::match(['put', 'patch'], '/', 'update')->middleware('can:update permission');
        Route::delete('/', 'destroy')->middleware('can:delete permission');
        Route::patch('restore', 'restore')->middleware('can:update permission');
    });

    Route::controller(API\PostCategoryController::class)->prefix('post-category')->group(function () {
        Route::get('/', 'index')->middleware('can:read post category');
        Route::post('/', 'store')->middleware('can:insert post category');
        Route::match(['put', 'patch'], '/', 'update')->middleware('can:update post category');
        Route::delete('/', 'destroy')->middleware('can:delete post category');
        Route::patch('restore', 'restore')->middleware('can:update post category');
    });

    Route::controller(API\PostThreadController::class)->prefix('post-thread')->group(function () {
        Route::get('/', 'index')->middleware('can:read post thread');
    });

    Route::controller(API\PostController::class)->prefix('post')->group(function () {
        Route::get('/', 'index')->middleware('can:read post');
    });
});
