<?php

namespace Minion\Plugin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show list of all plugins.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table(['Name', 'Status', 'Order', 'Path'], $this->getRows());
    }

    /**
     * Get table rows.
     *
     * @return array
     */
    public function getRows()
    {
        $rows = [];

        foreach ($this->getPlugins() as $module) {
            $rows[] = [
                $module->getName(),
                $module->enabled() ? 'Enabled' : 'Disabled',
                $module->get('order'),
                $module->getPath(),
            ];
        }

        return $rows;
    }

    public function getPlugins()
    {
        switch ($this->option('only')) {
            case 'enabled':
                return $this->laravel['plugins']->getByStatus(1);
                break;

            case 'disabled':
                return $this->laravel['plugins']->getByStatus(0);
                break;

            case 'ordered':
                return $this->laravel['plugins']->getOrdered($this->option('direction'));
                break;

            default:
                return $this->laravel['plugins']->all();
                break;
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('only', null, InputOption::VALUE_OPTIONAL, 'Types of modules will be displayed.', null),
            array('direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'asc'),
        );
    }
}
