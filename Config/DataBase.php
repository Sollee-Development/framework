<?php
namespace Config;
class Database {
    private $environment;

    public function __construct(Environment $environment, DatabaseSettings $settings) {
        $this->environment = $environment;
        $this->settings = $settings;
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
            if (!$this->environment->getIsOnline()) return $this->settings->localUsername;
            else return $this->settings->onlineUsername;
        }
        elseif ($part === 'password') {
            if (!$this->environment->getIsOnline()) return $this->settings->localPassword;
            else return $this->settings->onlinePassword;
        }
    }
}
