<?php
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//header('Content-Type: text/html; charset=utf-8');
////header('Content-Type: application/json');


// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../routes/api.php';

use App\App;

(new App())->run();