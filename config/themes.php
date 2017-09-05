<?php

return [

    'default' => env('THEME', 'smkn4'),

    'path' => base_path('resources/themes'),

    'cache' => [
        'enabled' => false,
        'key' => 'app.themes',
        'lifetime' => 86400,
    ],

];
