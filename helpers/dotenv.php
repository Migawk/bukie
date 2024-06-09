<?php

use Dotenv\Dotenv;

try {

    require_once __DIR__ . '../../vendor/autoload.php';

    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
} catch (Exception $e) {
    var_dump($e);
}


?>