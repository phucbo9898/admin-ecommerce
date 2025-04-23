<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\DashboardController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
