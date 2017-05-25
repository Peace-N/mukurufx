<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 5:45 AM
 */

namespace Mukuru\MukuruFX;
use Illuminate\Support\ServiceProvider;

class MukuruFXServiceProvider extends ServiceProvider  {

    public function register() {
        $this->app->singleton( 'mukurufx', function () {
            return new MukuruFX;
        });
    }

    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/mukurufx'),
        ], 'public');
        $this->publishes([
            __DIR__.'/classes/readers/FXconfig.php' => config_path('mukurufxconfig.php'),
        ]);
    }

    private function publishMigrations() {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getMigrationsPath() {
        return __DIR__ . '/database/migrations/';
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'mukurufx');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

}