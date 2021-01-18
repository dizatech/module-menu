<?php

namespace Dizatech\ModuleMenu;

use App\Facades\ModuleMenusFacade;
use Illuminate\Support\ServiceProvider;


class ModuleMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views','moduleMenu');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/module-menu.php', 'module-menu');
        $this->publishes([
            __DIR__.'/config/module-menu.php' =>config_path('module-menu')
        ], 'module-menu');
    }
}
