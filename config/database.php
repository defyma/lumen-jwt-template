<?php
return [
    'default' => 'db',
    'migrations' => 'migrations',
    'connections' => [
        'db' => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

//        'db2' => [
//            'driver' => env('DB_CONNECTION_2'),
//            'host' => env('DB_HOST_2'),
//            'port' => env('DB_PORT_2'),
//            'database' => env('DB_DATABASE_2'),
//            'username' => env('DB_USERNAME_2'),
//            'password' => env('DB_PASSWORD_2'),
//            'charset' => 'utf8',
//            'prefix' => '',
//            'prefix_indexes' => true,
//        ],
    ],
];
