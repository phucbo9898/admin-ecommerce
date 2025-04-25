<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\UserController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

    Route::group(['middleware' => 'custom.auth:admin'], function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Users management
        Route::group(['as' => 'users.'], function () {
            Route::get('/users', [UserController::class, 'index'])->name('index');
            Route::get('/users/create', [UserController::class, 'create'])->name('create');
            Route::post('/users/create', [UserController::class, 'store'])->name('store');
            Route::get('/users/{user:uuid}/edit', [UserController::class, 'edit'])->name('edit');
            Route::patch('/users/{user:uuid}/update', [UserController::class, 'update'])->name('update');
            Route::delete('/users/{user:uuid}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Categories management
        Route::group(['as' => 'categories.'], function () {
            Route::get('/categories', [CategoryController::class, 'index'])->name('index');
            Route::get('/categories/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/categories/create', [CategoryController::class, 'store'])->name('store');
            Route::get('/categories/{category:uuid}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::patch('/categories/{category:uuid}/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('/categories/{category:uuid}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
});
