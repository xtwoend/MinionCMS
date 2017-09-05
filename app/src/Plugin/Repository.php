<?php

namespace Minion\Plugin;

use Countable;
use Minion\Application;
use Illuminate\Support\Str;
use Minion\Plugin\Contracts\RepositoryInterface;
use Minion\Plugin\Exceptions\PluginNotFoundException;

class Repository implements RepositoryInterface, Countable
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The plugin path.
     *
     * @var string|null
     */
    protected $path;

    /**
     * The scanned paths.
     *
     * @var array
     */
    protected $paths = [];

    /**
     * @var string
     */
    protected $stubPath;

    /**
     * The constructor.
     *
     * @param Application $app
     * @param string|null $path
     */
    public function __construct(Application $app, $path = null)
    {
        $this->app = $app;
        $this->path = $path;
    }

    /**
     * Add other plugin location.
     *
     * @param string $path
     *
     * @return $this
     */
    public function addLocation($path)
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * Alternative method for "addPath".
     *
     * @param string $path
     *
     * @return $this
     */
    public function addPath($path)
    {
        return $this->addLocation($path);
    }

    /**
     * Get all additional paths.
     *
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Get scanned plugins paths.
     *
     * @return array
     */
    public function getScanPaths()
    {
        $paths = $this->paths;

        $paths[] = $this->getPath().'/*';

        if ($this->config('scan.enabled')) {
            $paths = array_merge($paths, $this->config('scan.paths'));
        }

        return $paths;
    }

    /**
     * Get & scan all plugins.
     *
     * @return array
     */
    public function scan()
    {
        $paths = $this->getScanPaths();

        $plugins = [];

        foreach ($paths as $key => $path) {
            $manifests = $this->app['files']->glob("{$path}/plugin.json");

            is_array($manifests) || $manifests = [];

            foreach ($manifests as $manifest) {
                $name = Json::make($manifest)->get('name');

                $lowerName = strtolower($name);

                $plugins[$name] = new Plugin($this->app, $lowerName, dirname($manifest));
            }
        }

        return $plugins;
    }

    /**
     * Get all plugins.
     *
     * @return array
     */
    public function all()
    {
        if (!$this->config('cache.enabled')) {
            return $this->scan();
        }

        return $this->formatCached($this->getCached());
    }

    /**
     * [menus description]
     * @return [type] [description]
     */
    public function getMenus()
    {
        $menus = collect([]);

        foreach ($this->all() as $name => $plugin) {
            if(count($plugin->getMenu()) === 0) continue;
            $menus[] = $plugin->getMenu();
        }

        return $menus;

    }

    /**
     * Format the cached data as array of plugins.
     *
     * @param array $cached
     *
     * @return array
     */
    protected function formatCached($cached)
    {
        $plugins = [];

        foreach ($cached as $name => $plugin) {
            $path = $this->config('paths.plugins').'/'.$name;

            $plugins[] = new Plugin($this->app, $name, $path);
        }

        return $plugins;
    }

    /**
     * Get cached plugins.
     *
     * @return array
     */
    public function getCached()
    {
        return $this->app['cache']->remember($this->config('cache.key'), $this->config('cache.lifetime'), function () {
            return $this->toCollection()->toArray();
        });
    }

    /**
     * Get all plugins as collection instance.
     *
     * @return Collection
     */
    public function toCollection()
    {
        return new Collection($this->scan());
    }

    /**
     * Get plugins by status.
     *
     * @param $status
     *
     * @return array
     */
    public function getByStatus($status)
    {
        $plugins = [];

        foreach ($this->all() as $name => $plugin) {
            if ($plugin->isStatus($status)) {
                $plugins[$name] = $plugin;
            }
        }

        return $plugins;
    }

    /**
     * Determine whether the given plugin exist.
     *
     * @param $name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->all());
    }

    /**
     * Get list of enabled plugins.
     *
     * @return array
     */
    public function enabled()
    {
        return $this->getByStatus(1);
    }

    /**
     * Get list of disabled plugins.
     *
     * @return array
     */
    public function disabled()
    {
        return $this->getByStatus(0);
    }

    /**
     * Get count from all plugins.
     *
     * @return int
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * Get all ordered plugins.
     *
     * @param string $direction
     *
     * @return array
     */
    public function getOrdered($direction = 'asc')
    {
        $plugins = $this->enabled();

        uasort($plugins, function ($a, $b) use ($direction) {
            if ($a->order == $b->order) {
                return 0;
            }

            if ($direction == 'desc') {
                return $a->order < $b->order ? 1 : -1;
            }

            return $a->order > $b->order ? 1 : -1;
        });

        return $plugins;
    }

    /**
     * Get a plugin path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path ?: $this->config('paths.plugins');
    }

    /**
     * Register the plugins.
     */
    public function register()
    {
        foreach ($this->getOrdered() as $plugin) {
            $plugin->register();
        }
    }

    /**
     * Boot the plugins.
     */
    public function boot()
    {
        foreach ($this->getOrdered() as $plugin) {
            $plugin->boot();
        }
    }

    /**
     * Find a specific plugin.
     *
     * @param $name
     */
    public function find($name)
    {   
        
        foreach ($this->all() as $plugin) {
            if ($plugin->getLowerName() == strtolower($name)) {
                return $plugin;
            }
        }

        return;
    }

    /**
     * Alternative for "find" method.
     *
     * @param $name
     */
    public function get($name)
    {
        return $this->find($name);
    }

    /**
     * Find a specific plugin, if there return that, otherwise throw exception.
     *
     * @param $name
     *
     * @return plugin
     *
     * @throws PluginNotFoundException
     */
    public function findOrFail($name)
    {
        if (!is_null($plugin = $this->find($name))) {
            return $plugin;
        }

        throw new PluginNotFoundException("plugin [{$name}] does not exist!");
    }

    /**
     * Get all plugins as laravel collection instance.
     *
     * @return Collection
     */
    public function collections()
    {
        return new Collection($this->enabled());
    }

    /**
     * Get plugin path for a specific plugin.
     *
     * @param $plugin
     *
     * @return string
     */
    public function getPluginPath($plugin)
    {
        try {
            return $this->findOrFail($plugin)->getPath().'/';
        } catch (PluginNotFoundException $e) {
            return $this->getPath().'/'.Str::studly($plugin).'/';
        }
    }

    /**
     * Get asset path for a specific plugin.
     *
     * @param $plugin
     *
     * @return string
     */
    public function assetPath($plugin)
    {
        return $this->config('paths.assets').'/'.$plugin;
    }

    /**
     * Get a specific config data from a configuration file.
     *
     * @param $key
     *
     * @return mixed
     */
    public function config($key)
    {
        return $this->app['config']->get('plugins.'.$key);
    }

    /**
     * Get storage path for plugin used.
     *
     * @return string
     */
    public function getUsedStoragePath()
    {
        if (!$this->app['files']->exists($path = storage_path('app/plugins'))) {
            $this->app['files']->makeDirectory($path, 0777, true);
        }

        return $path.'/plugins.used';
    }

    /**
     * Set plugin used for cli session.
     *
     * @param $name
     *
     * @throws PluginNotFoundException
     */
    public function setUsed($name)
    {
        $plugin = $this->findOrFail($name);

        $this->app['files']->put($this->getUsedStoragePath(), $plugin);
    }

    /**
     * Get plugin used for cli session.
     *
     * @return string
     */
    public function getUsedNow()
    {
        return $this->findOrFail($this->app['files']->get($this->getUsedStoragePath()));
    }

    /**
     * Get used now.
     *
     * @return string
     */
    public function getUsed()
    {
        return $this->getUsedNow();
    }

    /**
     * Get laravel filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    public function getFiles()
    {
        return $this->app['files'];
    }

    /**
     * Get plugin assets path.
     *
     * @return string
     */
    public function getAssetsPath()
    {
        return $this->config('paths.assets');
    }

    /**
     * Get asset url from a specific plugin.
     *
     * @param string $asset
     * @param bool   $secure
     *
     * @return string
     */
    public function asset($asset)
    {
        list($name, $url) = explode(':', $asset);

        $baseUrl = str_replace(public_path(), '', $this->getAssetsPath());

        $url = $this->app['url']->asset($baseUrl."/{$name}/".$url);

        return str_replace(['http://', 'https://'], '//', $url);
    }

    /**
     * Determine whether the given plugin is activated.
     *
     * @param string $name
     *
     * @return bool
     */
    public function active($name)
    {
        return $this->findOrFail($name)->active();
    }

    /**
     * Determine whether the given plugin is not activated.
     *
     * @param string $name
     *
     * @return bool
     */
    public function notActive($name)
    {
        return !$this->active($name);
    }

    /**
     * Enabling a specific plugin.
     *
     * @param string $name
     *
     * @return bool
     */
    public function enable($name)
    {
        return $this->findOrFail($name)->enable();
    }

    /**
     * Disabling a specific plugin.
     *
     * @param string $name
     *
     * @return bool
     */
    public function disable($name)
    {
        return $this->findOrFail($name)->disable();
    }

    /**
     * Delete a specific plugin.
     *
     * @param string $name
     *
     * @return bool
     */
    public function delete($name)
    {
        return $this->findOrFail($name)->delete();
    }

    /**
     * Get stub path.
     *
     * @return string
     */
    public function getStubPath()
    {
        if (!is_null($this->stubPath)) {
            return $this->stubPath;
        }

        if ($this->config('stubs.enabled')) {
            return $this->config('stubs.path');
        }

        return $this->stubPath;
    }

    /**
     * Set stub path.
     *
     * @param string $stubPath
     *
     * @return $this
     */
    public function setStubPath($stubPath)
    {
        $this->stubPath = $stubPath;

        return $this;
    }
}
