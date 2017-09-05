<?php

namespace Minion\Plugin\Process;

class Updater extends Runner
{
    /**
     * Update the dependencies for the specified plugin by given the plugin name.
     *
     * @param string $plugin
     */
    public function update($plugin)
    {
        $plugin = $this->plugin->findOrFail($plugin);

        $packages = $plugin->getComposerAttr('require', []);

        chdir(base_path());

        foreach ($packages as $name => $version) {
            $package = "\"{$name}:{$version}\"";

            $this->run("composer require {$package}");
        }

        $devPackages = $plugin->getComposerAttr('require-dev', []);
        foreach ($devPackages as $name => $version) {
            $package = "\"{$name}:{$version}\"";

            $this->run("composer require --dev {$package}");
        }
    }
}
