<?php 

namespace Minion\Plugin;

use Minion\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class Plugin extends ServiceProvider
{	
	/**
     * The lumen application instance.
     *
     * @var Minion\Application
     */
    protected $app;

    /**
     * The module name.
     *
     * @var
     */
    protected $name;

    /**
     * The module path,.
     *
     * @var string
     */
    protected $path;

    /**
     * The constructor.
     *
     * @param \Minion\Application $app
     * @param $name
     * @param $path
     */
    public function __construct(Application $app, $name, $path)
    {
        $this->app = $app;
        $this->name = $name;
        $this->path = realpath($path);
    }

	/**
     * Get laravel instance.
     *
     * @return \Minion\Application
     */
    public function getLaravel()
    {
        return $this->app;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get name in lower case.
     *
     * @return string
     */
    public function getLowerName()
    {
        return strtolower($this->name);
    }

    /**
     * [getMenu description]
     * @return [type] [description]
     */
    public function getMenu()
    {   
        if($this->active() && is_file($this->path.'/'.'menu.php')){
            return include($this->path.'/'.'menu.php');
        }
        return [];
    }

    /**
     * Get name in studly case.
     *
     * @return string
     */
    public function getStudlyName()
    {
        return Str::studly($this->name);
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Get alias.
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->get('alias');
    }

    /**
     * Get priority.
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->get('priority');
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
	

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->registerTranslation();

        $this->fireEvent('boot');
    }

    /**
     * Register plugin's translation.
     *
     * @return void
     */
    protected function registerTranslation()
    {
        $lowerName = $this->getLowerName();

        $langPath = base_path("resources/lang/{$lowerName}");
        
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $lowerName);
        }
    }

    /**
     * Get json contents.
     *
     * @return Json
     */
    public function json()
    {
        return new Json($this->getPath().'/plugin.json', $this->app['files']);
    }

    /**
     * Get a specific data from json file by given the key.
     *
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->json()->get($key, $default);
    }

    /**
     * Register the plugin.
     */
    public function register()
    {
        $this->registerAliases();
        $this->registerProviders();
        $this->registerFiles();
        // $this->registerRoute();
        $this->registerConfig();
        $this->fireEvent('register');
    }

    /**
     * Register the plugin event.
     *
     * @param string $event
     */
    protected function fireEvent($event)
    {
        $this->app['events']->fire(sprintf('plugin.%s.'.$event, $this->getLowerName()), [$this]);
    }

    /**
     * Register the aliases from this plugin.
     */
    protected function registerAliases()
    {
        foreach ($this->get('aliases', []) as $aliasName => $aliasClass) {
            class_alias($aliasClass, $aliasName);
        }
    }

    /**
     * Register the service providers from this plugin.
     */
    protected function registerProviders()
    {
        foreach ($this->get('providers', []) as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the files from this plugin.
     */
    protected function registerFiles()
    {
        foreach ($this->get('files', []) as $file) {
            include $this->path.'/'.$file;
        }
    }

    /**
     * Register Route from this plugin
     */
    public function registerRoute()
    {
        foreach ($this->get('routes', []) as $route) {
            $this->app['router']->group(['namespace' => 'Plugins\\'.$this->getStudlyName().'\\Http\\Controllers'], function ($app) use ($route) {
                require $this->path.'/'.$route;
            });
        }   
    }

    /**
     * Load config plugin
     */
    public function registerConfig()
    {
        $this->app->make('config')->set($this->getLowerName(), require $this->path.'/'.'config.php');
    }

    /**
     * Handle call __toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getStudlyName();
    }

    /**
     * Determine whether the given status same with the current module status.
     *
     * @param $status
     *
     * @return bool
     */
    public function isStatus($status)
    {
        return $this->get('active', 0) == $status;
    }

    /**
     * Determine whether the current plugin activated.
     *
     * @return bool
     */
    public function enabled()
    {
        return $this->active();
    }

    /**
     * Alternate for "enabled" method.
     *
     * @return bool
     */
    public function active()
    {
        return $this->isStatus(1);
    }

    /**
     * Determine whether the current module not activated.
     *
     * @return bool
     */
    public function notActive()
    {
        return !$this->active();
    }

    /**
     * Alias for "notActive" method.
     *
     * @return bool
     */
    public function disabled()
    {
        return !$this->enabled();
    }

    /**
     * Set active state for current plugin.
     *
     * @param $active
     *
     * @return bool
     */
    public function setActive($active)
    {
        return $this->json()->set('active', $active)->save();
    }

    /**
     * Disable the current plugin.
     *
     * @return bool
     */
    public function disable()
    {
        $this->app['events']->fire('plugin.disabling', [$this]);

        $this->setActive(0);

        $this->app['events']->fire('plugin.disabled', [$this]);
    }

    /**
     * Enable the current plugin.
     */
    public function enable()
    {
        $this->app['events']->fire('plugin.enabling', [$this]);

        $this->setActive(1);

        $this->app['events']->fire('plugin.enabled', [$this]);
    }

    /**
     * Delete the current plugin.
     *
     * @return bool
     */
    public function delete()
    {
        return $this->json()->getFilesystem()->deleteDirectory($this->getPath(), true);
    }

    /**
     * Get extra path.
     *
     * @param $path
     *
     * @return string
     */
    public function getExtraPath($path)
    {
        return $this->getPath().'/'.$path;
    }

    /**
     * Handle call to __get method.
     *
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }
}