<?php

namespace Minion\Plugin\Generators;

use Illuminate\Config\Repository as Config;
use Illuminate\Console\Command as Console;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Minion\Plugin\Stub;
use Minion\Plugin\Repository;

class PluginGenerator extends Generator
{
    /**
     * The plugin name will created.
     *
     * @var string
     */
    protected $name;

    /**
     * The laravel config instance.
     *
     * @var Config
     */
    protected $config;

    /**
     * The laravel filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * The laravel console instance.
     *
     * @var Console
     */
    protected $console;

    /**
     * The minion plugin instance.
     *
     * @var plugin
     */
    protected $plugin;

    /**
     * Force status.
     *
     * @var bool
     */
    protected $force = false;

    /**
     * Generate a plain plugin.
     *
     * @var bool
     */
    protected $plain = false;

    /**
     * The constructor.
     *
     * @param $name
     * @param Repository $plugin
     * @param Config     $config
     * @param Filesystem $filesystem
     * @param Console    $console
     */
    public function __construct(
        $name,
        Repository $plugin = null,
        Config $config = null,
        Filesystem $filesystem = null,
        Console $console = null
    ) {
        $this->name = $name;
        $this->config = $config;
        $this->filesystem = $filesystem;
        $this->console = $console;
        $this->plugin = $plugin;
    }

    /**
     * Set plain flag.
     *
     * @param bool $plain
     *
     * @return $this
     */
    public function setPlain($plain)
    {
        $this->plain = $plain;

        return $this;
    }

    /**
     * Get the name of plugin will created. By default in studly case.
     *
     * @return string
     */
    public function getName()
    {
        return Str::studly($this->name);
    }

    /**
     * Get the laravel config instance.
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the laravel config instance.
     *
     * @param Config $config
     *
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get the laravel filesystem instance.
     *
     * @return Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Set the laravel filesystem instance.
     *
     * @param Filesystem $filesystem
     *
     * @return $this
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * Get the laravel console instance.
     *
     * @return Console
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * Set the laravel console instance.
     *
     * @param Console $console
     *
     * @return $this
     */
    public function setConsole($console)
    {
        $this->console = $console;

        return $this;
    }

    /**
     * Get the minion plugin instance.
     *
     * @return plugin
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * Set the minion plugin instance.
     *
     * @param mixed $plugin
     *
     * @return $this
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;

        return $this;
    }

    /**
     * Get the list of folders will created.
     *
     * @return array
     */
    public function getFolders()
    {   
        return array_values($this->plugin->config('paths.generator'));
    }

    /**
     * Get the list of files will created.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->plugin->config('stubs.files');
    }

    /**
     * Set force status.
     *
     * @param bool|int $force
     *
     * @return $this
     */
    public function setForce($force)
    {
        $this->force = $force;

        return $this;
    }

    /**
     * Generate the plugin.
     */
    public function generate()
    {
        $name = $this->getName();

        if ($this->plugin->has($name)) {
            if ($this->force) {
                $this->plugin->delete($name);
            } else {
                $this->console->error("plugin [{$name}] already exist!");

                return;
            }
        }

        $this->generateFolders();

        $this->generateFiles();

        if (!$this->plain) {
            $this->generateResources();
        }

        $this->console->info("plugin [{$name}] created successfully.");
    }

    /**
     * Generate the folders.
     */
    public function generateFolders()
    {
        foreach ($this->getFolders() as $folder) {
            $path = $this->plugin->getPluginPath($this->getName()).'/'.$folder;

            $this->filesystem->makeDirectory($path, 0755, true);

            $this->generateGitKeep($path);
        }
    }

    /**
     * Generate git keep to the specified path.
     *
     * @param string $path
     */
    public function generateGitKeep($path)
    {
        $this->filesystem->put($path.'/.gitkeep', '');
    }

    /**
     * Generate the files.
     */
    public function generateFiles()
    {   

        foreach ($this->getFiles() as $stub => $file) {
            $path = $this->plugin->getPluginPath($this->getName()).$file;
           
            if (!$this->filesystem->isDirectory($dir = dirname($path))) {
                $this->filesystem->makeDirectory($dir, 0775, true);
            }

            $this->filesystem->put($path, $this->getStubContents($stub));

            $this->console->info("Created : {$path}");
        }
    }

    /**
     * Generate some resources.
     */
    public function generateResources()
    {
        $this->console->call('plugin:make-provider', [
            'name' => $this->getName().'ServiceProvider',
            'plugin' => $this->getName(),
            '--master' => true,
        ]);
        
        $this->console->call('plugin:make-controller', [
            'controller' => $this->getName().'Controller',
            'plugin' => $this->getName(),
        ]);
    }

    /**
     * Get the contents of the specified stub file by given stub name.
     *
     * @param $stub
     *
     * @return Stub
     */
    protected function getStubContents($stub)
    {   
        return (new Stub(
            '/'.$stub.'.stub',
            $this->getReplacement($stub))
        )->render();
    }

    /**
     * get the list for the replacements.
     */
    public function getReplacements()
    {
        return $this->plugin->config('stubs.replacements');
    }

    /**
     * Get array replacement for the specified stub.
     *
     * @param $stub
     *
     * @return array
     */
    protected function getReplacement($stub)
    {
        $replacements = $this->plugin->config('stubs.replacements');

        $namespace = $this->plugin->config('namespace');
        
        if (!isset($replacements[$stub])) {
            return [];
        }

        $keys = $replacements[$stub];

        $replaces = [];
        
        foreach ($keys as $key) {
            if (method_exists($this, $method = 'get'.ucfirst(studly_case(strtolower($key))).'Replacement')) {
                $replaces[$key] = call_user_func([$this, $method]);
            } else {
                $replaces[$key] = null;
            }
        }

        return $replaces;
    }

    /**
     * Get the plugin name in lower case.
     *
     * @return string
     */
    protected function getLowerNameReplacement()
    {
        return strtolower($this->getName());
    }

    /**
     * Get the plugin name in studly case.
     *
     * @return string
     */
    protected function getStudlyNameReplacement()
    {
        return $this->getName();
    }

    /**
     * Get replacement for $VENDOR$.
     *
     * @return string
     */
    protected function getVendorReplacement()
    {
        return $this->plugin->config('composer.vendor');
    }

    /**
     * Get replacement for $PLUGIN_NAMESPACE$.
     *
     * @return string
     */
    protected function getPluginNamespaceReplacement()
    {
        return str_replace('\\', '\\\\', $this->plugin->config('namespace'));
    }

    /**
     * Get replacement for $AUTHOR_NAME$.
     *
     * @return string
     */
    protected function getAuthorNameReplacement()
    {
        return $this->plugin->config('composer.author.name');
    }

    /**
     * Get replacement for $AUTHOR_EMAIL$.
     *
     * @return string
     */
    protected function getAuthorEmailReplacement()
    {
        return $this->plugin->config('composer.author.email');
    }
}
