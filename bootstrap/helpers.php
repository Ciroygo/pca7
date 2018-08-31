<?php

function get_db_config()
{
    $app_env = [
        'local' => 'LOCAL_',
        'staging' => 'STAGING_',
        'production' => 'PRODUCTION_'
    ];

    $prefix = isset($app_env[config('app.env')]) ? $app_env[config('app.env')] : "";


    return $db_config = [
        'connection' => env($prefix.'DB_CONNECTION', 'mysql'),
        'host' => env($prefix.'DB_HOST', 'localhost'),
        'database'  => env($prefix.'DB_DATABASE', 'forge'),
        'username'  => env($prefix.'DB_USERNAME', 'forge'),
        'password'  => env($prefix.'DB_PASSWORD', ''),
    ];
}