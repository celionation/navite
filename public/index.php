<?php

define('ROOT_DIR', realpath(dirname(__FILE__)));

$autoload = ROOT_DIR . '/../vendor/autoload.php';

if(is_file($autoload)) {
    require $autoload;
}

use NaviteCore\Application\BaseApplication;

$app = new BaseApplication(ROOT_DIR);

$app->run()
->setSession();
