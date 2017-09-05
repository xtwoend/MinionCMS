<?php

namespace Minion\Widgets;

use Minion\Widgets\Console\WidgetMakeCommand;
use Minion\Widgets\Factories\AsyncWidgetFactory;
use Minion\Widgets\Factories\WidgetFactory;
use Minion\Widgets\Misc\LaravelApplicationWrapper;
use Illuminate\Support\Facades\Blade;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('minion.widget', function () {
            return new WidgetFactory(new LaravelApplicationWrapper());
        });

        $this->app->bind('minion.async-widget', function () {
            return new AsyncWidgetFactory(new LaravelApplicationWrapper());
        });

        $this->app->singleton('minion.widget-group-collection', function () {
            return new WidgetGroupCollection(new LaravelApplicationWrapper());
        });

        $this->app->singleton('command.widget.make', function ($app) {
            return new WidgetMakeCommand($app['files']);
        });

        $this->commands('command.widget.make');

        $this->app->alias('minion.widget', 'Minion\Widgets\Factories\WidgetFactory');
        $this->app->alias('minion.async-widget', 'Minion\Widgets\Factories\AsyncWidgetFactory');
        $this->app->alias('minion.widget-group-collection', 'Minion\Widgets\WidgetGroupCollection');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $routeConfig = [
            'namespace'  => 'Minion\Widgets\Controllers',
            'prefix'     => 'minion',
            'middleware' => $this->app['config']->get('widgets.route_middleware', []),
        ];

        if (!$this->app->routesAreCached()) {
            $this->app['router']->group($routeConfig, function ($router) {
                $router->get('load-widget', 'WidgetController@showWidget');
            });
        }

        $omitParenthesis = version_compare($this->app->version(), '5.3', '<');

        Blade::directive('widget', function ($expression) use ($omitParenthesis) {
            $expression = $omitParenthesis ? $expression : "($expression)";
            return "<?php echo app('minion.widget')->run{$expression}; ?>";
        });

        Blade::directive('asyncWidget', function ($expression) use ($omitParenthesis) {
            $expression = $omitParenthesis ? $expression : "($expression)";

            return "<?php echo app('minion.async-widget')->run{$expression}; ?>";
        });

        Blade::directive('widgetGroup', function ($expression) use ($omitParenthesis) {
            $expression = $omitParenthesis ? $expression : "($expression)";

            return "<?php echo app('minion.widget-group-collection')->group{$expression}->display(); ?>";
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['minion.widget', 'minion.async-widget'];
    }
}
