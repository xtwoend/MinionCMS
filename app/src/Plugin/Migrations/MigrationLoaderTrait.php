<?php

namespace Minion\Plugin\Migrations;

trait MigrationLoaderTrait
{
    /**
     * Include all migrations files from the specified plugin.
     *
     * @param string $plugin
     */
    protected function loadMigrationFiles($plugin)
    {
        $path = $this->laravel['plugins']->getPluginPath($plugin) . $this->getMigrationGeneratorPath();

        $files = $this->laravel['files']->glob($path . '/*_*.php');

        foreach ($files as $file) {
            $this->laravel['files']->requireOnce($file);
        }
    }

    /**
     * Get migration generator path.
     *
     * @return string
     */
    protected function getMigrationGeneratorPath()
    {
        return $this->laravel['plugins']->config('paths.generator.migration');
    }
}
