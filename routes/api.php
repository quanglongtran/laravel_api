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

Route::prefix('auth')->group(function () {
    Route::controller(API\AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::get('profile', 'profile');
        Route::put('change-info', 'update');
    });

    Route::controller(API\UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:read user');
        Route::get('{user}', 'show')->middleware('isAllowed:read user');
        Route::post('/', 'store')->middleware('isAllowed:insert user');
        Route::match(['put', 'patch'], '/{user}', 'update')->middleware('isAllowed:update user');
        Route::delete('soft-delete/{user}', 'delete')->middleware('isAllowed:soft delete user');
        Route::delete('force-delete/{user}', 'destroy')->middleware('isAllowed:force delete user');
        Route::patch('restore/{userWithTrashed}', 'restore')->middleware('isAllowed:update user');
    });

    Route::controller(API\RoleController::class)->prefix('role')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:decentralization');
        Route::get('{role}', 'show')->middleware('isAllowed:decentralization');
        Route::post('/', 'store')->middleware('isAllowed:decentralization');
        Route::match(['put', 'patch'], '/{role}', 'update')->middleware('isAllowed:decentralization');
        Route::delete('soft-delete/{role}', 'delete')->middleware('isAllowed:decentralization');
        Route::delete('force-delete/{role}', 'destroy')->middleware('isAllowed:decentralization');
        Route::patch('restore/{roleWithTrashed}', 'restore')->middleware('isAllowed:decentralization');
        Route::post('give-permission-to/{role}', 'givePermissionTo')->middleware('isAllowed:decentralization');
        Route::post('sync-permission/{role}', 'syncPermissions')->middleware('isAllowed:decentralization');
        Route::post('revoke-permission-to/{role}', 'revokePermissionTo')->middleware('isAllowed:decentralization');
    });

    Route::controller(API\PermissionController::class)->prefix('permission')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:read permission');
        Route::get('{permission}', 'show')->middleware('isAllowed:read permission');
        Route::post('/', 'store')->middleware('isAllowed:insert permission');
        Route::match(['put', 'patch'], '/{permission}', 'update')->middleware('isAllowed:update permission');
        Route::delete('soft-delete/{permission}', 'delete')->middleware('isAllowed:soft delete permission');
        Route::delete('force-delete/{permission}', 'destroy')->middleware('isAllowed:force delete permission');
        Route::patch('restore/{permissionWithTrashed}', 'restore')->middleware('isAllowed:update permission');
    });

    Route::controller(API\PostCategoryController::class)->prefix('post-category')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:read post category');
        Route::get('{postCategory}', 'show')->middleware('isAllowed:read post category');
        Route::post('/', 'store')->middleware('isAllowed:insert post category');
        Route::match(['put', 'patch'], '/{postCategory}', 'update')->middleware('isAllowed:update post category');
        Route::delete('soft-delete/{postCategory}', 'delete')->middleware('isAllowed:soft delete post category');
        Route::delete('force-delete/{postCategory}', 'destroy')->middleware('isAllowed:force delete post category');
        Route::patch('restore/{postCategoryWithTrashed}', 'restore')->middleware('isAllowed:update post category');
    });

    Route::controller(API\PostThreadController::class)->prefix('post-thread')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:read post thread');
        Route::get('{postThread}', 'show')->middleware('isAllowed:read post thread');
        Route::post('/', 'store')->middleware('isAllowed:insert post thread');
        Route::match(['put', 'patch'], '/{postThread}', 'update')->middleware('isAllowed:update post thread');
        Route::delete('soft-delete/{postThread}', 'delete')->middleware('isAllowed:soft delete post thread');
        Route::delete('force-delete/{postThread}', 'destroy')->middleware('isAllowed:force delete post thread');
        Route::patch('restore/{postThreadWithTrashed}', 'restore')->middleware('isAllowed:update post thread');
    });

    Route::controller(API\PostController::class)->prefix('post')->group(function () {
        Route::get('/', 'index')->middleware('isAllowed:read post');
        Route::get('{post}', 'show')->middleware('isAllowed:read post');
        Route::post('/', 'store')->middleware('isAllowed:insert post');
        Route::match(['put', 'patch'], '/{post}', 'update')->middleware('isAllowed:update post');
        Route::delete('soft-delete/{post}', 'delete')->middleware('isAllowed:soft delete post');
        Route::delete('force-delete/{post}', 'destroy')->middleware('isAllowed:force delete post');
        Route::patch('restore/{postWithTrashed}', 'restore')->middleware('isAllowed:update post');
    });
});
