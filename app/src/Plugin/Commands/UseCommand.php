<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class UseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:use';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use the specified plugin.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plugin = Str::studly($this->argument('plugin'));

        if (!$this->laravel['plugins']->has($plugin)) {
            $this->error("plugin [{$plugin}] does not exists.");

            return;
        }

        $this->laravel['plugins']->setUsed($plugin);

        $this->info("plugin [{$plugin}] used successfully.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('plugin', InputArgument::REQUIRED, 'The name of plugin will be used.'),
        );
    }
}
