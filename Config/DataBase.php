<?php
namespace Config;
class Database {
    private $environment;
    private $settings;
    private $defaultDSN;

    public function __construct(Environment $environment, DatabaseSettings $settings) {
        $this->environment = $environment;
        $this->settings = $settings;
        $this->defaultDSN = "mysql:host=localhost;dbname=";
    }

    public function getDBInfo($part) {
        if ($part === 'dsn') {
            $name = $this->settings->dbName;
            if (!$this->environment->getIsOnline()) return $this->defaultDSN . $name;
            // If it is Online
            else if ($this->environment->getDebug()) return $this->defaultDSN . ($this->settings->onlineDBPrefix ?? "") . $name;
            else return $this->defaultDSN . ($this->settings->onlineDBPrefix ?? "") . ($this->settings->testDBPrefix ?? "") . $name;
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
