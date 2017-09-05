<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Minion\Plugin\Migrations\Migrator;
use Minion\Plugin\Migrations\MigrationLoaderTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateRollbackCommand extends Command
{
    use MigrationLoaderTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:migrate-rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the plugins migrations.';

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

        if (!empty($name)) {
            $this->rollback($name);

            return;
        }

        foreach ($this->plugin->getOrdered($this->option('direction')) as $plugin) {
            $this->line('Running for plugin: <info>' . $plugin->getName() . '</info>');

            $this->rollback($plugin);
        }
    }

    /**
     * Rollback migration from the specified plugin.
     *
     * @param $plugin
     */
    public function rollback($plugin)
    {
        if (is_string($plugin)) {
            $plugin = $this->plugin->findOrFail($plugin);
        }

        $migrator = new Migrator($plugin);

        $database = $this->option('database');

        if (!empty($database)) {
            $migrator->setDatabase($database);
        }

        $migrated = $migrator->rollback();

        if (count($migrated)) {
            foreach ($migrated as $migration) {
                $this->line("Rollback: <info>{$migration}</info>");
            }

            return;
        }

        $this->comment('Nothing to rollback.');
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
            array('direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'desc'),
            array('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'),
            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'),
            array('pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'),
        );
    }
}