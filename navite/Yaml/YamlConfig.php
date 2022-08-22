<?php

declare(strict_types=1);

namespace NaviteCore\Yaml;

use Symfony\Component\Yaml\Yaml;
use NaviteCore\GlobalManager\Exception\BaseException;

class YamlConfig
{
    private function isFileExists(string $filename)
    {
        if(!file_exists($filename)) {
            throw new BaseException($filename . " does not exists.");
        }
    }

    public function getYaml(string $yamlFile)
    {
        foreach(glob(CONFIG_PATH . DS . "*.yaml") as $file) {
            $this->isFileExists($file);
            $parts = parse_url($file);
            $path = $parts['path'];
            if(strpos($path, $yamlFile) !== false) {
                return Yaml::parseFile($yamlFile);
            }
        }
    }

    public static function file(string $yamlFile)
    {
        return (new YamlConfig)->getYaml($yamlFile);
    }

}