<?php


return array(
	
	'mode'          	=> 'development',
	
	'debug'         	=> true,
	// Path to the content folder
	'content_path' 		=> BASE_PATH . 'content/',
	// The file extension to use for content files
	'content_extension' => '.md',

	'base_url'			=> 'localhost/me/',

	'log'			=> [
						'enabled' 	=> true,
						'writer'	=> null,
						'level' 	=> \Slim\Log::DEBUG
					],
	'routes'		=> [
						'case_sensitive' => true
					]
);