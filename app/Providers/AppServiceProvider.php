<?php

declare(strict_types=1);

namespace App\Providers;

use App\Extensions\DatabaseSessionHandler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Session::extend('custom_session_driver', function ($app) {
            $table = config('session.table');
            $minutes = config('session.lifetime');

            return new DatabaseSessionHandler(DB::connection(config('session.connection')), $table, $minutes, $app);
        });
    }
}
