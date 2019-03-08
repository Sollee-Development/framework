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
        $fileName = __DIR__ . '/../' . $file;
        if (!file_exists($fileName)) return false;

        $settings = json_decode(str_replace('{dir}', dirname($file), file_get_contents($fileName)), true);
        if (isset($settings['extend'])) {
            $settings = array_merge($this->getFile($settings['extend']), $settings);
        }
        return $settings;

    }
}
