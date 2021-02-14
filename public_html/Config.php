<?php

class Config
{

    private $conf;

    public function __construct()
    {
        $this->conf = include(__DIR__.'/config/appconfig.php');
    }
    public function getConf(string $type, string $value) : array
    {
        return $this->conf[$type][$value];
    }
    public function setConf(array $configs) : Config
    {
        $defaultConf = $this->conf;
        $this->conf = array_merge($defaultConf, $configs);
        return $this;
    }
}

