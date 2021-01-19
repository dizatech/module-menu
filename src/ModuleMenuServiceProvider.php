<?php

namespace Dizatech\ModuleMenu;

use Dizatech\ModuleMenu\Facades\ModuleMenusFacade;
use Dizatech\ModuleMenu\Services\Helpers\ModuleMenusHelper;
use Dizatech\ModuleMenu\View\Components\ModuleMenu;
use Illuminate\Foundation\AliasLoader;
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
        ModuleMenusFacade::shouldProxyTo(ModuleMenusHelper::class);
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('ModuleMenu', ModuleMenusFacade::class);
        });
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
        $this->loadViewComponentsAs('', [
            ModuleMenu::class
        ]);
    }
}
