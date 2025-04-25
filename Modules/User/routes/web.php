<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.', 'middleware' => 'custom.auth:user'], function () {
    Route::get('/', function () {
        return view('user::index');
    })->name('index');
});
