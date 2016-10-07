<?php
namespace Config;
class Environment {
    private $name;
    private $isRemoteServer;
    private $debug;

    public function __construct($name) {
        $this->name = $name;
        if (strpos($_SERVER['REQUEST_URI'], $name)) $this->isRemoteServer = false;
        else $this->isRemoteServer = true;
        // Set Debug
        if (strpos($_SERVER['SERVER_NAME'], 'test') !== false || !$this->isRemoteServer) $this->debug = true;
        else $this->debug = false;
    }

    public function getName() {
        return $this->name;
    }

    public function getIsOnline() {
        return $this->isRemoteServer;
    }

    public function getDebug() {
        return $this->debug;
    }

    public function getRoot() {
        if (!$this->isRemoteServer) return '/' . $this->name . '/';
        else return DIRECTORY_SEPARATOR;
    }
}
