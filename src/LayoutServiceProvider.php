<?php

namespace ElementsFramework\Layout;


use Illuminate\Support\ServiceProvider;

class LayoutServiceProvider extends ServiceProvider
{

    /**
     * Bootstraps the package.
     *
     * @return void
     */
    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/Migration');

        // Configuration publishing
        $this->publishes([
            __DIR__.'/Configuration/layout.php' => config_path('layout.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/Configuration/layout.php', 'layout'
        );

        // Frontend
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'LayoutBuilder');
        $this->publishes([
            __DIR__.'/View' => resource_path('views/vendor/elements-framework/layout'),
        ]);
        $this->publishes([
            dir(__DIR__).'dependencies/ui' => public_path('vendor/elements-framework/layout'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Commands
        /*$this->commands([
            Console\CompileRoutesCommand::class,
            Console\PublishProvidedRoutesCommand::class,
            Console\CleanupProvidedRoutesCommand::class,
            Console\SyncProvidedRoutesCommand::class,
        ]);*/

        // Services
        /*$this->app->bind('ElementsFramework\DynamicRouting\Service\Compiler\RouteDeclarationCompiler', function($app) {
            return new Service\Compiler\RouteDeclarationCompiler();
        });*/
    }

}