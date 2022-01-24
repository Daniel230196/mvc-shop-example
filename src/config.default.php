<?php

const PROJECT_SOURCE = __DIR__.'/';
const PROJECT_ROOT   = __DIR__.'/../';

return [
    'paths' => [
        'templates' => PROJECT_SOURCE.'templates/',
        'templates_cache' => PROJECT_SOURCE.'cache/twig',
        'additional_config_dir' => [/* paths to dir with additional configuration files */ PROJECT_SOURCE.'additional/config'],
    ],
    'database' => [
        'drivers' => [
            'mysql' => ['user' => 'root', 'password' => '1234', 'host' => 'mysql', 'port' => '3306'],
            /** @TODO: realize another db connection config patterns */
        ],
    ],
];