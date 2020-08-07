<?php

namespace DevDojo\Chatter;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use DevDojo\Chatter\Models\Models;
=======
use Mews\Purifier\PurifierServiceProvider;
>>>>>>> eb6ea466a9b7e55c6ebb5a83497f50d10a538b65

class ChatterServiceProvider extends ServiceProvider
{
    /**
     * Where publish routes can be written, and will be registered by Chatter.
     *
     * @var string
     */
    public $publishRouteFile = '/routes/chatter/web.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'chatter');
        $this->publishes([
            __DIR__.'/../public/assets' => public_path('vendor/devdojo/chatter/assets'),
        ], 'chatter_assets');

        $this->publishes([
            __DIR__.'/../config/chatter.php' => config_path('chatter.php'),
        ], 'chatter_config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'chatter_migrations');

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds'),
        ], 'chatter_seeds');

        $this->publishes([
            __DIR__.'/Lang' => resource_path('lang/vendor/chatter'),
        ], 'chatter_lang');

        // include the routes file
        include __DIR__.'/Routes/web.php';

        view()->composer(['chatter::blocks.sidebar', 'chatter::discussion', 'chatter::home'], function($view) {
            $view->with('categories', Models::category()->orderBy('order')->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the service provider for the dependency.
         */
        $this->app->register(PurifierServiceProvider::class);

        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Purifier', 'Mews\Purifier\Facades\Purifier');

        $this->loadViewsFrom(__DIR__.'/Views', 'chatter');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // if the custom routes file is published, register its routes
        if (file_exists(base_path().$this->publishRouteFile)) {
            $this->loadRoutesFrom(base_path().$this->publishRouteFile);
        }
    }
}
