<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class DisableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable the specified plugin.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plugin = $this->laravel['plugins']->findOrFail($this->argument('plugin'));

        if ($plugin->enabled()) {
            $plugin->disable();

            $this->info("Plugin [{$plugin}] disabled successful.");
        } else {
            $this->comment("Plugin [{$plugin}] has already disabled.");
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
            array('plugin', InputArgument::REQUIRED, 'plugin name.'),
        );
    }
}
