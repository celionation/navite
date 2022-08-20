<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

use NaviteCore\Application\Application;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 0);

$whoops = new Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->on(Application::EVENT_BEFORE_REQUEST, function(){
    
});

$app->run();