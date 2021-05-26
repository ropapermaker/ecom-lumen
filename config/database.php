<?php

return  [
    'default' => 'mysql',
    'migrations' => 'migrations',

    'connections' => [
        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'mongodb' => array(
            'driver'   => 'mongodb',
            'dsn'      => env('DB_DSN'),
            'database' => env('DB_DATABASE_MONGO'),
        ),
    ],
];