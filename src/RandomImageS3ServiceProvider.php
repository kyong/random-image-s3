<?php
namespace Kyong\RandomImageS3;

use Illuminate\Support\ServiceProvider;

class RandomImageS3ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/route.php';

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'config');
            $this->publishes([__DIR__.'/route.php' => base_path('routes')], 'random-image-s3-route');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'random-image-s3-migrations');
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}