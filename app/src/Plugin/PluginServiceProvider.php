<?php 

namespace Minion\Plugin;

use Illuminate\Support\ServiceProvider;
use Minion\Plugin\Stub;

class PluginServiceProvider extends ServiceProvider 
{
	/**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Booting the package.
     */
    public function boot()
    {
        // boot plugin
        $this->app['plugins']->boot();

        // stub booted
        $this->setupStubPath();
    }

    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->registerRepositoryContracts();
        $this->registerCommand();

        //register plugin  
        $this->app['plugins']->register();
        
    }

    /**
     * Register the service provider.
     */
    protected function registerServices()
    {
        $this->app->singleton('plugins', function ($app) {
            $path = $app['config']->get('plugins.paths.plugins');
            return new Repository($app, $path);
        });
    }

    /**
     * [registerRepositoryContracts description]
     * @return [type] [description]
     */
    public function registerRepositoryContracts()
    {
        $this->app->bind(
            'Minion\Plugin\Contracts\RepositoryInterface',
            'Minion\Plugin\Repository'
        );
    }

    /**
     * [registerCommand description]
     * @return [type] [description]
     */
    public function registerCommand()
    {
        $this->commands([
            'Minion\Plugin\Commands\UseCommand',
            'Minion\Plugin\Commands\SeedCommand',
            'Minion\Plugin\Commands\MakeCommand',
            'Minion\Plugin\Commands\ListCommand',
            'Minion\Plugin\Commands\EnableCommand',
            'Minion\Plugin\Commands\DisableCommand',
            'Minion\Plugin\Commands\InstallCommand',
            'Minion\Plugin\Commands\MigrateCommand',
            'Minion\Plugin\Commands\SeedMakeCommand',
            'Minion\Plugin\Commands\MigrationCommand',
            'Minion\Plugin\Commands\ControllerCommand',
            'Minion\Plugin\Commands\MigrateResetCommand',
            'Minion\Plugin\Commands\MigrateRefreshCommand',
            'Minion\Plugin\Commands\MigrateRollbackCommand',
            'Minion\Plugin\Commands\GenerateProviderCommand',
        ]);
    }

    /**
     * Setup stub path.
     */
    public function setupStubPath()
    {   
        Stub::setBasePath(__DIR__.'/Commands/stubs');

        if ($this->app['plugins']->config('stubs.enabled') === true) {
            Stub::setBasePath($this->app['plugins']->config('stubs.path'));
        }
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('plugins');
    }
}