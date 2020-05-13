<?php

namespace A1tem\KnowledgeBase;

use A1tem\Knowledgebase\Console\AssetsCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class KnowledgeBaseServiceProvider
 *
 * @package A1tem\KnowledgeBase
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class KnowledgeBaseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'a1tem');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app['router']->namespace('A1tem\\KnowledgeBase\\Controllers')
            ->middleware(['web', 'api'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
            });

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/knowledge-base.php', 'knowledge-base');

        // Register the service the package provides.
        $this->app->singleton('knowledge-base', function ($app) {
            return new KnowledgeBase;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['knowledge-base'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/knowledge-base.php' => config_path('knowledge-base.php'),
        ], 'knowledge-base.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/a1tem'),
        ], 'knowledge-base.views');

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/a1tem/knowledge-base'),
        ], 'knowledge-base.views');


        // Registering package commands.
        $this->commands([
            Console\AssetsCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../resources/assets/js' =>
                resource_path('js/knowledge-base')
        ], 'knowledge-base.vue-components');


        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
