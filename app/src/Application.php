<?php

namespace Minion;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{   
    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected $basePath;
    
    /**
     * [__construct description]
     * @param [type] $basePath [description]
     */
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
    }

    /**
     * Set the base path for the application.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->bindPathsInContainer();
        $this->instance('path.widgets', $this->widgetPath());
        $this->instance('path.plugins', $this->pluginPath());

        return $this;
    }

    /**
     * Get the path to the Application "Minion" directory.
     *
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'src'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * [widgetPath description]
     * @return [type] [description]
     */
    public function widgetPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'widgets'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * [widgetPath description]
     * @return [type] [description]
     */
    public function pluginPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'plugins'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

}