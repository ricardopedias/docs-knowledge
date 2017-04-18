<?php

namespace Plexi\Foundation;

use Illuminate\Support\ServiceProvider;

class PlexiFoundationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'foundation');
        
        // Config
        // php artisan vendor:publish
        $this->publishes([__DIR__.'/config/plexi.php' => config_path('plexi.php')]);
        
        // Views
        // php artisan vendor:publish
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/plexi/foundation')]);
        
        // Assets
        $this->publishes([__DIR__.'/public' => public_path('plexi/foundation')]);
        
        // Alternativa agrupada em 'public' (pode ser qualquer palavra)
        // php artisan vendor:publish --tag=public --force
        //$this->publishes([__DIR__.'/public' => public_path('plexi/foundation')], 'public');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Adiciona as configurações padrões no namespace plexi
        $this->mergeConfigFrom(__DIR__.'/config/plexi.php', 'plexi');
        
        //$this->app->make('Plexi\Foundation\Http\Controllers\ExampleController');
        
    }
}
