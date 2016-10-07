<?php
namespace Config;
class Modules {
    private $environment;

    public function __construct($modules = [], $configFile = "config.json") {
        $this->modules = $modules;
        $this->configFile = $configFile;
    }

    public function getModuleSettings() {
        $moduleSettings = [];
        foreach ($this->modules as $moduleName) {
            if (file_exists('Modules/' . $moduleName . '/' . $this->configFile))
                $moduleSettings['Modules/' . $moduleName . '/'] =
                    json_decode(file_get_contents('Modules/' . $moduleName . '/' . $this->configFile), true);
        }
        return $moduleSettings;
    }
}
