<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Minion\Plugin\Plugin;
use Minion\Plugin\Repository;
use RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SeedCommand extends Command
{
    use PluginCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run database seeder from the specified plugin or from all plugins.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            if ($name = $this->argument('plugin')) {
                $name = Str::studly($name);
                $this->pluginSeed($this->getPluginByName($name));
            } else {
                $plugins = $this->getPluginRepository()->getOrdered();

                array_walk($plugins, [$this, 'pluginSeed']);
                $this->info('All plugins seeded.');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * @throws RuntimeException
     *
     * @return Repository
     */
    public function getPluginRepository()
    {
        $plugins = $this->laravel['plugins'];
        if (!$plugins instanceof Repository) {
            throw new RuntimeException("plugin repository not found!");
        }

        return $plugins;
    }

    /**
     * @param $name
     *
     * @throws RuntimeException
     *
     * @return Plugin
     */
    public function getPluginByName($name)
    {
        $plugins = $this->getPluginRepository();
        if ($plugins->has($name) === false) {
            throw new RuntimeException("Plugin [$name] does not exists.");
        }

        return $plugins->get($name);
    }

    /**
     * @param Plugin $plugin
     *
     * @return void
     */
    public function pluginSeed(Plugin $plugin)
    {   
        $seeders = [];
        $name = $plugin->getName();
        $config = $plugin->get('migration');
        if (is_array($config) && array_key_exists('seeds', $config)) {
            foreach ((array)$config['seeds'] as $class) {
                if (@class_exists($class)) {
                    $seeders[] = $class;
                }
            }
        } else {
            $class = $this->getSeederName($name); //legacy support
            if (@class_exists($class)) {
                $seeders[] = $class;
            }
        }

        if (count($seeders) > 0) {
            array_walk($seeders, [$this, 'dbSeed']);
            $this->info("plugin [$name] seeded.");
        }
    }

    /**
     * Seed the specified plugin.
     *
     * @param string $className
     *
     * @return array
     */
    protected function dbSeed($className)
    {
        $params = [
            '--class' => $className,
        ];

        if ($option = $this->option('database')) {
            $params['--database'] = $option;
        }

        if ($option = $this->option('force')) {
            $params['--force'] = $option;
        }

        $this->call('db:seed', $params);
    }

    /**
     * Get master database seeder name for the specified plugin.
     *
     * @param string $name
     *
     * @return string
     */
    public function getSeederName($name)
    {   
        $name = Str::studly($name);

        $namespace = $this->laravel['plugins']->config('namespace');

        if ($seederName = $this->argument('name')){
            return $namespace . '\\' . $name . '\Database\Seeders\\' . $seederName;
        }else{
            return $namespace . '\\' . $name . '\Database\Seeders\\' . $name . 'DatabaseSeeder';
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
            array('plugin', InputArgument::OPTIONAL, 'The name of plugin will be used.'),
            array('name', InputArgument::OPTIONAL, 'The name of seeder will be used.'),
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
            array('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed.'),
            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'),
        );
    }
}
