<?php

namespace Minion\Themes\Providers;

use Minion\Themes\Repository;
use Minion\Themes\Finder\Finder;
use Illuminate\Support\ServiceProvider;
use Minion\Themes\View\ThemeFileViewFinder;

class ThemesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->registerNamespaces();
        $this->app['themes']->set(config('themes.default'));
    }

    /**
     * Register the themes namespaces.
     */
    protected function registerNamespaces()
    {
        $this->app['themes']->registerNamespaces();
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];
            return new ThemeFileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('themes', function ($app) {
            return new Repository(
                new Finder(),
                $app['config'],
                $app['view'],
                $app['translator'],
                $app['cache.store']
            );
        });

        $this->registerCommands();
        $this->registerViewFinder();
    }

    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands('Minion\Themes\Console\MakeCommand');
        $this->commands('Minion\Themes\Console\CacheCommand');
        $this->commands('Minion\Themes\Console\ListCommand');
        $this->commands('Minion\Themes\Console\PublishCommand');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('themes');
    }
}
