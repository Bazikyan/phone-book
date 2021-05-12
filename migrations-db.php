<?php


require __DIR__ . '/config/bootstrap.php';

return [
    'dbname' => $_ENV['MYSQL_DBNAME'],
    'user' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'driver' => $_ENV['MYSQL_DRIVER'],
    'host' => $_ENV['MYSQL_HOST'],
];
