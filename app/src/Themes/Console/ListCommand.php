<?php

namespace Minion\Themes\Console;

use Illuminate\Console\Command;

class ListCommand extends Command
{
    /**
     * Command name.
     *
     * @var string
     */
    protected $name = 'theme:list';

    /**
     * Command description.
     *
     * @var string
     */
    protected $description = 'Show the available themes';

    /**
     * Execute command.
     */
    public function handle()
    {
        $this->table(['Name', 'Path', 'Enabled', 'Parent', 'Active'], $this->getRows());
    }

    /**
     * Get table rows.
     *
     * @return array
     */
    public function getRows()
    {
        $rows = [];

        $themes = $this->laravel['themes']->all();
        
        foreach ($themes as $theme) {
            $rows[] = [
                $theme->getName(),                
                $theme->getPath(),
                $theme->enabled() ? 'Yes' : 'No',
                $theme->getParent(),
                $theme->isActive() ? 'Yes' : 'No',
            ];
        }

        return $rows;
    }
}
