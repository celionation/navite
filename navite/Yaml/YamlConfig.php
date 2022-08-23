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

    /**
     * Load a Yaml configuration
     *
     * @param string $yamlFile
     * @return void
     * @throws ParseException
     */
    public function getYaml(string $yamlFile)
    {
        foreach(glob(CONFIG_PATH . DS . "*.yaml") as $file) {
            $this->isFileExists($file);
            $parts = parse_url($file);
            $path = $parts['path'];
            if(strpos($path, $yamlFile) !== false) {
                return Yaml::parseFile($file);
            }
        }
    }

    /**
     * Load a Yaml configuration into the yaml parser
     *
     * @param string $yamlFile
     */
    public static function file(string $yamlFile)
    {
        return (new YamlConfig)->getYaml($yamlFile);
    }

}