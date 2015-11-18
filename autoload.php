<?php

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 'Access Denied';
    exit;
}

spl_autoload_register(function ($className) {

    $className = str_replace('\\', '/', $className);
    $fileName = __DIR__ . '/' . $className . '.php';

    if (is_readable($fileName)){
    	require_once $fileName;
    } 
});

require_once('config.php');
