<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AddressController;
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
            Route::get('/users/list-address-by-user/{user:uuid}', [AddressController::class, 'listAddressByUser'])->name('listAddressByUser');
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

        // Address Management
        Route::group(['as' => 'address.'], function () {
            Route::get('/address', [AddressController::class, 'index'])->name('index');
            Route::get('/address/create/{user:uuid?}', [AddressController::class, 'create'])->name('create');
            Route::post('/address/store', [AddressController::class, 'store'])->name('store');
            Route::get('/address/{address:uuid}/edit', [AddressController::class, 'edit'])->name('edit');
            Route::patch('/address/{address:uuid}/update', [AddressController::class, 'update'])->name('update');
            Route::delete('/address/{address:uuid}', [AddressController::class, 'destroy'])->name('destroy');
        });
    });
});
