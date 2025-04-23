<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admin', AdminController::class)->names('admin');
});
