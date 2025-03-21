<?php
require_once __DIR__ . '/../vendor/autoload.php';

use LoggerApp\Application;
use LoggerApp\Loggers\LoggerFactory;

$fileConfig = ['filepath' => __DIR__ . '/../app.log'];
$cloudConfig = ['apiKey' => '1234XYZ'];
$logger = LoggerFactory::createLogger('file', $fileConfig);
$app = new Application($logger);

$app->doSomething();
$app->handleError();
