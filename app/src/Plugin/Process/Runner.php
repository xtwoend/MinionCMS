<?php

namespace Minion\Plugin\Process;

use Minion\Plugin\Contracts\RunableInterface;
use Minion\Plugin\Repository;

class Runner implements RunableInterface
{
    /**
     * The plugin instance.
     *
     * @var \Minion\Plugin\Repository
     */
    protected $plugin;

    /**
     * The constructor.
     *
     * @param \Minion\Plugin\Repository $plugin
     */
    public function __construct(Repository $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
