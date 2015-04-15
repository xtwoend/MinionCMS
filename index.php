<?php

//define('INSTALL', true);

session_cache_limiter(false);
session_start();


/*
|--------------------------------------------------------------------------
| bootsrap app
|--------------------------------------------------------------------------
*/
$app = require_once __DIR__.'/app/start/run.php';

//run application
$app->run();
