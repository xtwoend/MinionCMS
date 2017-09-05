<?php

namespace Minion\Themes;

use Minion\Themes\Finder\Finder;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator;
use Illuminate\View\Factory;

class Repository implements Arrayable
{
    /**
     * The Pingpong Themes Finder Object.
     *
     * @var Finder
     */
    protected $finder;

    /**
     * The Laravel Config Repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The Laravel Translator.
     *
     * @var Translator
     */
    protected $lang;

    /**
     * The Laravel View.
     *
     * @var Factory
     */
    protected $views;

    /**
     * The current theme active.
     *
     * @var string
     */
    protected $current;

    /**
     * The path of themes.
     *
     * @var
     */
    protected $path;

    /**
     * The constructor.
     *
     * @param Finder     $finder
     * @param Config     $config
     * @param Factory    $views
     * @param Translator $lang
     * @param Cache      $cache
     *
     * @internal param Factory $view
     */
    public function __construct(
        Finder $finder,
        Config $config,
        Factory $views,
        Translator $lang,
        Cache $cache
    ) {
        $this->finder = $finder;
        $this->config = $config;
        $this->lang = $lang;
        $this->views = $views;
        $this->cache = $cache;
    }

    /**
     * Register the namespaces.
     */
    public function registerNamespaces()
    { 
        foreach ($this->all() as $theme) {
            foreach (array('views', 'lang') as $hint) {
                $this->{$hint}->addNamespace($theme->getName(), $theme->getPath($hint));
            }            
            $theme->boot();
        }
    }

    /**
     * Find the specified theme.
     *
     * @param string $search
     *
     * @return \Minion\Themes\Theme|null
     */
    public function find($search)
    {   
        foreach ($this->all() as $theme) {
            if ($theme->getName() == strtolower($search)) {
                return $theme;
            }
        }

        return;
    }

    /**
     * Get theme path by given theme name.
     *
     * @param $theme
     *
     * @return null|string
     */
    public function getThemePath($theme)
    {
        return $this->getPath() . "/{$theme}";
    }

    /**
     * Get current theme.
     *
     * @return string
     */
    public function getCurrent()
    {
        return $this->current ?: $this->config->get('themes.default');
    }

    /**
     * Set current theme.
     *
     * @param string $current
     *
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;
        
        $this->init();

        return $this;
    }

    /**
     * The alias "setCurrent" method.
     *
     * @param $theme
     *
     * @return $this
     */
    public function set($theme)
    {   
        return $this->setCurrent($theme);
    }

    /**
     * [init description]
     * @param  [type] $theme [description]
     * @return [type]        [description]
     */
    public function init($default=null)
    { 
        if (is_null($default)) {
            $default = $this->getCurrent();
        }

        $theme = $this->find($default); 
        if($theme instanceof Theme){
            $this->registerViewLocation($theme->getName());
            if($theme->hasParent()){
                if(!$this->find($theme->getParent())){
                    throw new \Exception("Theme {$theme->getName()} required {$theme->getParent()}", 1);
                }
            }
        }
    }

    /**
     * Get all themes.
     *
     * @return array
     */
    public function all()
    {
        if ($this->useCache()) {
            return $this->cache->remember($this->getCacheKey(), $this->getCacheLifetime(), function () {
                return $this->scan();
            });
        }

        return $this->scan();
    }

    /**
     * Get all themes.
     *
     * @return array
     */
    public function scan()
    {
        return $this->finder->find($this->getPath());
    }

    /**
     * Get cached themes.
     *
     * @return array
     */
    public function getCached()
    {
        return $this->cache->get($this->getCacheKey(), []);
    }

    /**
     * Determine whether the cache is enabled.
     *
     * @return bool
     */
    public function useCache()
    {
        return $this->getCacheStatus() == true;
    }

    /**
     * Get cache key.
     *
     * @return string
     */
    public function getCacheKey()
    {
        return $this->config->get('themes.cache.key');
    }

    /**
     * Get cache lifetime.
     *
     * @return int
     */
    public function getCacheLifetime()
    {
        return $this->config->get('themes.cache.lifetime');
    }

    /**
     * Get cache status.
     *
     * @return bool
     */
    public function getCacheStatus()
    {
        return $this->config->get('themes.cache.enabled');
    }

    /**
     * Cache the themes.
     */
    public function cache()
    {
        $this->cache->remember($this->getCacheKey(), $this->getCacheLifetime(), function () {
            return $this->scan();
        });
    }

    /**
     * Forget cached themes.
     */
    public function forgetCache()
    {
        $this->cache->forget($this->getCacheKey());
    }

    /**
     * Convert all themes to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($theme) {
            return $theme->toArray();
        }, $this->scan());
    }

    /**
     * Convert all themes to a json string.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Check whether the given theme in all themes.
     *
     * @param $theme
     *
     * @return bool
     */
    public function has($theme)
    {
        return !is_null($this->find($theme));
    }

    /**
     * Alias for "has" method.
     *
     * @param $theme
     *
     * @return bool
     */
    public function exists($theme)
    {
        return $this->has($theme);
    }

    /**
     * Set theme path on runtime.
     *
     * @param $path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get theme path.
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path ?: $this->config->get('themes.path');
    }

    /**
     * [getActiveTheme description]
     * @return Minion\Themes\Theme
     */
    public function getActiveTheme()
    {
        return $this->find($this->getCurrent());
    }

    /**
     * Get view from current theme.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     *
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
    {
        return $this->views->make($this->getThemeNamespace($view), $data, $mergeData);
    }
    
    /**
     * Get asset for theme
     * 
     * @param $asset
     * @param $secure
     * 
     * @return asset
     */
    public function asset($asset, $secure = null)
    {
        if (Str::contains($asset, '::')) {
            list($theme, $asset) = explode('::', $asset);
            $theme = $this->find($theme);
        } else {
            $theme = $this->getCurrent();
            $theme = $this->find($theme);
        }
        
        $path = 'assets/'. $theme->getName() . DIRECTORY_SEPARATOR;

        return url($path . $asset, null, $secure);
    }
    
    /**
     * Get secure asset
     * 
     * @param $asset
     * 
     * @return asset
     */
    public function secure_asset($asset)
    {
        return $this->asset($asset, true);
    }
    
    /**
     * Register view location of theme.
     *
     * @param null $theme
     */
    public function registerViewLocation($theme = null)
    {
        if (is_null($theme)) {
            $theme = $this->getCurrent();
        }
        
        $currentTheme = $this->find($theme);
        $path = $currentTheme->getPath() . '/views';
        $this->views->getFinder()->setPaths([$path]);
    }

    /**
     * Get config from current theme.
     *
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function config($key, $default = null)
    {
        if (Str::contains($key, '::')) {
            list($theme, $config) = explode('::', $key);
        } else {
            $theme = $this->getCurrent();
            $config = $key;
        }

        $theme = $this->find($theme);

        return $theme ? $theme->config($config) : $default;
    }

    /**
     * Get lang from current theme.
     *
     * @param $key
     * @param array $replace
     * @param null  $locale
     *
     * @return string
     */
    public function lang($key, $replace = array(), $locale = null)
    {
        return $this->lang->get($this->getThemeNamespace($key), $replace, $locale);
    }

    /**
     * Get theme namespace by given key.
     *
     * @param $key
     *
     * @return string
     */
    protected function getThemeNamespace($key)
    {
        return $this->getCurrent()."::{$key}";
    }

    /**
     * Get theme namespace.
     *
     * @param string $key
     *
     * @return string
     */
    public function getNamespace($key)
    {
        return $this->getThemeNamespace($key);
    }

    /**
     * Register a view composer to current theme.
     *
     * @param string|array    $views
     * @param string|callable $callback
     * @param int|null        $priority
     */
    public function composer($views, $callback, $priority = null)
    {
        $theViews = [];

        foreach ((array) $views as $view) {
            $theViews[] = $this->getThemeNamespace($view);
        }

        $this->views->composer($theViews, $callback, $priority);
    }
}
