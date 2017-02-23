<?php
namespace Config;
class Resources {
    private $environment;
    private $modules;
    private $defaultResources;

    public function __construct(Environment $environment, Modules $modules, $defaultResources = []) {
        $this->environment = $environment;
        $this->modules = $modules;
        $this->defaultResources = $defaultResources;
    }

    public function getResource($type) {
        $resources = $this->defaultResources[$type];
        foreach ($this->modules->getModuleSettings() as $moduleFolderPath => $settings) {
            if (!isset($settings['resources']) || !isset($settings['resources'][$type])) continue;
            else $files = $settings['resources'][$type];
            $files = array_map(function ($file) use ($moduleFolderPath) {
                if (strpos($file, 'http') === 0) return $file;
                return $moduleFolderPath . $file;
            }, $files);
            $resources = array_merge($resources, $files);
        }
        if ($this->environment->getIsOnline()) $resources = array_map(function ($file) {
            return '../' . $file;
        }, $resources);
        return $resources;
    }
}