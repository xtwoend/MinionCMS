<?php

namespace Minion\Themes\Console;

use Minion\Themes\Theme;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class PublishCommand extends Command
{
    /**
     * Command name.
     *
     * @var string
     */
    protected $name = 'theme:publish';

    /**
     * Filesystem
     * @var Illuminate\Filesystem\Filesystem;
     */
    protected $files;

    /**
     * Command description.
     *
     * @var string
     */
    protected $description = 'Publish theme\'s assets';

    /**
     * [__construct description]
     * @param Filesystem $files [description]
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute command.
     */
    public function handle()
    {
        if ($theme = $this->argument('name')) {
            $this->publish($theme);
        }

        $this->publishAll();
    }

    /**
     * Publish all themes.
     */
    protected function publishAll()
    {
        foreach ($this->laravel['themes']->all() as $theme) {
            $this->publish($theme);
        }
    }

    /**
     * Publish theme.
     *
     * @param mixed $theme
     */
    protected function publish($theme)
    {
        $theme = $theme instanceof Theme ? $theme : $this->laravel['themes']->find($theme);

        if (!is_null($theme)) {

            $assetsPath = $theme->getPath('assets');
            $distPath = public_path('assets');

            if (! $this->files->isDirectory($distPath)) {
                $this->files->makeDirectory($distPath, 0777, true, true);
            }

            if(! $this->files->isDirectory($distPath . DIRECTORY_SEPARATOR . $theme->getName())){
                symlink($assetsPath, $distPath . DIRECTORY_SEPARATOR . $theme->getName());
            }

            
            $this->line("Asset published from: <info>{$theme->getName()}</info>");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'The name of the theme being used.'],
        ];
    }
}
