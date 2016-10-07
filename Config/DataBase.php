<?php
namespace Config;
class DataBase {
    private $environment;

    public function __construct(Environment $environment) {
        $this->environment = $environment;
    }

    public function getDBInfo($part) {
        if ($part === 'dsn') {
            $name = $this->environment->getName();
            if (!$this->environment->getIsOnline()) return "mysql:host=localhost;dbname=" . $name;
            else {
                if ($this->environment->getDebug()) return "mysql:host=localhost;dbname=" . $name;
                else return "mysql:host=localhost;dbname=" . $name;
            }
        }
        elseif ($part === 'username') {
            if (!$this->environment->getIsOnline()) return "";
            else return "";
        }
        elseif ($part === 'password') {
            if (!$this->environment->getIsOnline()) return "";
            else return "";
        }
    }
}
