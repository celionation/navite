<?php

declare(strict_types=1);

namespace NaviteCore\Application;

use NaviteCore\Application\Config;
use NaviteCore\Traits\SystemTrait;

class BaseApplication
{
    protected string $appRoot;

    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;
    }

    public function run(): self
    {
        $this->constants();
        if(version_compare($phpVersion = PHP_VERSION, $coreVersion = Config::NAVITE_MIN_VERSION, '<')) {
            die(sprintf("You are running php %s, but the core framework requires at least PHP %s", $phpVersion, $coreVersion));
        }
        $this->environment();
        $this->errorHandler();
        return $this;
    }

    private function constants(): void
    {
        define('DS', DIRECTORY_SEPARATOR);
        define('APP_ROOT', $this->appRoot);
        define('CONFIG_PATH', APP_ROOT . DS . 'Config');
        define('TEMPLATES_PATH', APP_ROOT . DS . 'App/templates');
        define('LOG_DIR', APP_ROOT . DS . 'tmp/log');
    }

    private function environment()
    {
        ini_set('default_charset', 'UTF-8');
    }

    private function errorHandler(): void
    {
        error_reporting(E_ALL | E_STRICT);
        set_error_handler('NaviteCore\ErrorHandling\ErrorHandling::errorHandler');
        set_exception_handler('NaviteCore\ErrorHandling\ErrorHandling::exceptionHandler');
    }

    public function setSession()
    {
        SystemTrait::sessionInit(true);
        return $this;
    }

}