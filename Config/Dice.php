<?php
namespace Config;
class Dice {
    private $modules;
    private $defaultDiceFiles;

    public function __construct(Modules $modules, $defaultDiceFiles = []) {
        $this->modules = $modules;
        $this->defaultDiceFiles = $defaultDiceFiles;
    }

    public function getDiceFiles() {
        $diceFiles = $this->defaultDiceFiles;
        foreach ($this->modules->getModuleSettings() as $moduleFolderPath => $settings) {
            if (!isset($settings['dice']) || $settings['dice'] === false) continue;
            elseif ($settings['dice'] === true) $file = "dice.json";
            else $file = $settings['dice'];
            if (is_array($file)) {
                foreach ($file as $diceFile) {
                    $diceFiles[] = $moduleFolderPath . $diceFile;
                }
            }
            $diceFiles[] = $moduleFolderPath . $file;
        }
        return $diceFiles;
    }
}
