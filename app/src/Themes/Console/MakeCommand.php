<?php

namespace Minion\Themes\Console;

use Minion\Themes\Libraries\Stub;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeCommand extends Command
{
    /**
     * Command name.
     *
     * @var string
     */
    protected $name = 'theme:make';

    /**
     * Command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme';

    /**
     * Execute command.
     */
    public function handle()
    {   
        $name = strtolower($this->argument('name'));
        
        if ($this->laravel['themes']->has($name) && !$this->option('force')) {
            $this->error('Theme already exists.');
            return;
        }

        $this->generate($name);
    }

    /**
     * Generate a new theme by given theme name.
     *
     * @param string $name
     */
    protected function generate($name)
    {
        $stubPath   = __DIR__.'/../stubs';
        
        $themePath  = config('themes.path'). DIRECTORY_SEPARATOR . $name ;

        $this->laravel['files']->copyDirectory($stubPath.'/theme', $themePath);
        
        Stub::createFromPath($stubPath.'/json.stub', compact('name'))
            ->saveTo($themePath, 'theme.json')
        ;

        Stub::createFromPath($stubPath.'/theme.stub')
            ->saveTo($themePath, 'theme.php')
        ;

        $this->info('Theme created successfully.');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the theme being created. '],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Force creation if theme already exists.'],
        ];
    }
}
