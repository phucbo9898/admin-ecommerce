<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::group(['as' => 'user.'], function () {
    Route::get('/', function () {
        return view('user::index');
    })->name('index');
});
