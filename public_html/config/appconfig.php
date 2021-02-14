<?php

return [
    'database' => [
        'mysql' => [
            'dsn' => 'mysql:dbname=learn;host=localhost',
            'login' => 'debian-sys-maint',
            'password' => '6y5rvzvLcCUIReA4',
            'Pdo-default' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        ],
    ],
];