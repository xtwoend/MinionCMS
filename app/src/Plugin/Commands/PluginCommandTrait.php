<?php

namespace Minion\Plugin\Commands;

trait PluginCommandTrait
{
    /**
     * Get the plugin name.
     *
     * @return string
     */
    public function getPluginName()
    {
        $plugin = $this->argument('plugin') ?: $this->laravel['plugins']->getUsedNow();

        $plugin = $this->laravel['plugins']->findOrFail($plugin);

        return $plugin->getStudlyName();
    }
}
