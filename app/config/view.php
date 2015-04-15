<?php

return array(

	/**
	* engine template twig
	*/
	'engine'  => new \Slim\Views\Twig(),

	'debug' => true,
    
    'cache' => APP_PATH. 'cache',

	'views'	=> BASE_PATH. 'themes/',

	'themes' => 'proui'

); 