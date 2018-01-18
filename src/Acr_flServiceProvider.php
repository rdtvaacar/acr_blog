<?php

namespace Acr\Acr_blog;

use Acr\Acr_blog\Controllers\AcrblogController;
use Illuminate\Support\ServiceProvider;

class Acr_blogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . "/routes.php";
        $this->loadViewsFrom(__DIR__ . '/views', 'Acr_blogv');
        $this->publishes([
            __DIR__ . '/Public/Fonts/' => base_path('/public_html/acr/blog'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Acr_blog', function () {
            return new AcrblogController();
        });
    }
}
