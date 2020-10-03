<?php

namespace MeinderA\Forum;

use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../public/assets' => public_path('forum/assets'),
        ], 'forum_assets');

        $this->publishes([
            __DIR__.'/../config/forum.php' => config_path('forum.php'),
        ], 'forum_config');

        $this->publishes([
            __DIR__ . '/../database/seeders/' => database_path('seeders'),
        ], 'forum_seeders');


        // include the routes file
        include __DIR__.'/Routes/web.php';
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
        $this->app->register(\Mews\Purifier\PurifierServiceProvider::class);

        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Purifier', 'Mews\Purifier\Facades\Purifier');

        $this->loadTranslationsFrom(__DIR__.'/Lang', 'forum');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/Views', 'forum');
    }
}
