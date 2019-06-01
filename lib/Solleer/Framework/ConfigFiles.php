<?php

namespace Solleer\Framework;

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
            $file = $settings[$this->property] ?? [];
            if (is_array($file)) $files = array_merge($files, $file);
            else $files[] = $file;
        }
        return $files;
    }
}
