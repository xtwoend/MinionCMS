<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Minion\Plugin\Json;
use Minion\Plugin\Process\Installer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the specified plugin by given package name (vendor/name).';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (is_null($this->argument('name'))) {
            $this->installFromFile();

            return;
        }

        $this->install(
            $this->argument('name'),
            $this->argument('version'),
            $this->option('type'),
            $this->option('tree')
        );
    }

    /**
     * Install plugins from plugins.json file.
     */
    protected function installFromFile()
    {
        if (!file_exists($path = base_path('plugins.json'))) {
            $this->error("File 'plugins.json' does not exist in your project root.");

            return;
        }

        $plugins = Json::make($path);

        $dependencies = $plugins->get('require', []);

        foreach ($dependencies as $plugin) {
            $plugin = collect($plugin);

            $this->install(
                $plugin->get('name'),
                $plugin->get('version'),
                $plugin->get('type')
            );
        }
    }

    /**
     * Install the specified plugin.
     *
     * @param string $name
     * @param string $version
     * @param string $type
     * @param bool   $tree
     */
    protected function install($name, $version = 'dev-master', $type = 'composer', $tree = false)
    {
        $installer = new Installer(
            $name,
            $version,
            $type ?: $this->option('type'),
            $tree ?: $this->option('tree')
        );

        $installer->setRepository($this->laravel['plugins']);

        $installer->setConsole($this);

        if ($timeout = $this->option('timeout')) {
            $installer->setTimeout($timeout);
        }

        if ($path = $this->option('path')) {
            $installer->setPath($path);
        }

        $installer->run();

        if (!$this->option('no-update')) {
            $this->call('plugin:update', [
                'plugin' => $installer->getPluginName(),
            ]);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::OPTIONAL, 'The name of plugin will be installed.'),
            array('version', InputArgument::OPTIONAL, 'The version of plugin will be installed.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('timeout', null, InputOption::VALUE_OPTIONAL, 'The process timeout.', null),
            array('path', null, InputOption::VALUE_OPTIONAL, 'The installation path.', null),
            array('type', null, InputOption::VALUE_OPTIONAL, 'The type of installation.', null),
            array('tree', null, InputOption::VALUE_NONE, 'Install the plugin as a git subtree', null),
            array('no-update', null, InputOption::VALUE_NONE, 'Disables the automatic update of the dependencies.', null),
        );
    }
}
