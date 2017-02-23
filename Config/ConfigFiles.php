<?php

namespace Config;

class ConfigFiles {
    private $modules;
    private $property;
    private $defaultFiles;

    public function __construct(Modules $modules, $property, $defaultFiles = []) {
        $this->modules = $modules;
        $this->property = $property;
        $this->defaultFiles = $defaultFiles;
    }

    public function getFiles() {
        $files = $this->defaultFiles;
        foreach ($this->modules->getModuleSettings() as $settings) {
            if (!isset($settings[$this->property]) || $settings[$this->property] === false) continue;
            else $file = $settings[$this->property];
            if (is_array($file)) {
                foreach ($file as $file) {
                    $files[] = $file;
                }
            }
            $files[] = $file;
        }
        return $files;
    }
}
