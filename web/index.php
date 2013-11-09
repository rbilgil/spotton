<?php

require_once __DIR__.'/../vendor/autoload.php';

$app=new Silex\Application();
$ctrl=new Spotton\Controllers\TestController();

$app->mount("/test", $ctrl);

$app->run();