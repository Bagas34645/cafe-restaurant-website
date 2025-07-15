<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Content;

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
        // Set custom pagination views
        Paginator::defaultView('pagination.bootstrap-5');
        Paginator::defaultSimpleView('pagination.simple-bootstrap-5');

        // Share content helper with all views
        View::composer('*', function ($view) {
            $view->with('contentHelper', function ($key, $default = null) {
                return Content::getByKey($key, $default);
            });
        });
    }
}
