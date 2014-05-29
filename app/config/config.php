<?php

return [
    'database' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'tifa',
            'password' => '',
            'port' => '3306',
            'database' => 'information_schema'
        ]
    ],
    'templating' => [
        'engine' => 'twig'
    ],
    'twig' => [
        'cache_dir' => __DIR__.'/../cache/twig'
    ]
];