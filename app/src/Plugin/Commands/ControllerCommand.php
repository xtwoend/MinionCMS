<?php

namespace Minion\Plugin\Commands;

use Minion\Plugin\Stub;
use Symfony\Component\Console\Input\InputArgument;

class ControllerCommand extends GeneratorCommand
{
    use PluginCommandTrait;

    /**
     * The name of argument being used.
     *
     * @var string
     */
    protected $argumentName = 'controller';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:make-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new restful controller for the specified plugin.';

    /**
     * Get controller name.
     *
     * @return string
     */
    public function getDestinationFilePath()
    {
        $path = $this->laravel['plugins']->getpluginPath($this->getpluginName());

        $controllerPath = $this->laravel['plugins']->config('paths.generator.controller');

        return $path.$controllerPath.'/'.$this->getControllerName().'.php';
    }

    /**
     * @return Stub
     */
    protected function getTemplateContents()
    {
        $plugin = $this->laravel['plugins']->findOrFail($this->getpluginName());

        return (new Stub('/controller.stub', [
            'PLUGINNAME' => $plugin->getStudlyName(),
            'CONTROLLERNAME' => $this->getControllerName(),
            'CLASS' => $this->getClass(),
            'NAMESPACE' => $plugin->getLowername(),
            'PLUGIN_NAMESPACE' => $this->laravel['plugins']->config('namespace'),
            'CLASS_NAMESPACE' => $this->getClassNamespace($plugin),
        ]))->render();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('controller', InputArgument::REQUIRED, 'The name of the controller class.'),
            array('plugin', InputArgument::OPTIONAL, 'The name of plugin will be used.'),
        );
    }

    /**
     * @return array|string
     */
    protected function getControllerName()
    {
        $controller = studly_case($this->argument('controller'));

        if (!str_contains(strtolower($controller), 'controller')) {
            $controller = $controller.'Controller';
        }

        return $controller;
    }

    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace()
    {
        return 'Http\Controllers';
    }
}
