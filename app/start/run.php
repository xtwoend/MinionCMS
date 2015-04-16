<?php

require __DIR__.'/autoload.php';
require __DIR__.'/../Core/Gear.php';
require __DIR__.'/../Core/helpers.php';

$gear = new Minion\Core\Gear;
$config = $gear->config();
$app = $gear->init();

/**
 * if install define route disable
 */
if(!defined('INSTALL')){
    
    /**
     * Start the route
     */
    require APP_PATH.'filters.php';
    require APP_PATH.'routes.php';

}


return $app;