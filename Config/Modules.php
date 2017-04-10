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
            $moduleFile = 'Modules/' . $moduleName . '/' . $this->configFile;
            if ($settings = $this->getFile($moduleFile)) $moduleSettings[] = $settings;
        }
        return $moduleSettings;
    }

    private function getFile($file) {
        if (!file_exists($file)) return false;

        $settings = json_decode(str_replace('{dir}', str_replace(getcwd(), '', dirname($file)), file_get_contents($file)), true);
        if (isset($settings['extend'])) {
            $settings = array_merge($this->getFile($settings['extend']), $settings);
        }
        return $settings;
    }
}
