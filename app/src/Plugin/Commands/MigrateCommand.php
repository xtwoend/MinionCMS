<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Minion\Plugin\Migrations\Migrator;
use Minion\Plugin\Plugin;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the migrations from the specified plugin or from all plugins.';

    /**
     * @var \Minion\Plugin\Repository
     */
    protected $plugin;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->plugin = $this->laravel['plugins'];

        $name = $this->argument('plugin');

        if ($name) {
            $plugin = $this->plugin->findOrFail($name);
            
            return $this->migrate($plugin);
        }

        foreach ($this->plugin->getOrdered($this->option('direction')) as $plugin) {
            $this->line('Running for plugin: <info>' . $plugin->getName() . '</info>');

            $this->migrate($plugin);
        }
    }

    /**
     * Run the migration from the specified plugin.
     *
     * @param Plugin $plugin
     *
     * @return mixed
     */
    protected function migrate(Plugin $plugin)
    {
        $path = str_replace(base_path(), '', (new Migrator($plugin))->getPath());
        $this->call('migrate', [
            '--path' => $path,
            '--database' => $this->option('database'),
            '--pretend' => $this->option('pretend'),
            '--force' => $this->option('force'),
        ]);

        if ($this->option('seed')) {
            $this->call('plugin:seed', ['plugin' => $plugin->getName()]);
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
            array('direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'asc'),
            array('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'),
            array('pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'),
            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'),
            array('seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'),
        );
    }
}