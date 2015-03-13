<?php

/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information.
 *
 */
return array(
    'db' => array(
        'driver' => 'pdo',
        'dsn' => 'mysql:dbname=onlinemarket;host=localhost',
        'username' => 'zend',
        'password' => 'password',
        'driver_options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        )
    )
);
