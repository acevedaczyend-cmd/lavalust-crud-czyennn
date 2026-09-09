<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'	=> getenv('DB_DRIVER') ?: 'mysql',
    'hostname'	=> getenv('DB_HOST') ?: 'mysql-1ae50f6f-lavalustproject1.c.aivencloud.com',
    'port'		=> getenv('DB_PORT') ?: 21503,
    'username'	=> getenv('DB_USERNAME') ?: (getenv('DB_USER') ?: 'avnadmin'),
    'password'	=> getenv('DB_PASSWORD') ?: 'AVNS_PIE4ft5nL6UkoDtHdqg',
    'database'	=> getenv('DB_NAME') ?: (getenv('DB_DATABASE') ?: 'mydb'),
    'charset'	=> 'utf8mb4',
    'dbprefix'	=> '',
    'path'      => ''
);

$database['default'] = $database['main'];
?>