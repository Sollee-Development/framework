<?php
namespace Solleer\Framework\Router;
class StaticPages implements \Level2\Router\Rule {
    private $dice;
    private $static_dir;

    public function __construct(\Dice\Dice $dice, $static_dir = 'Modules/Static', $layout_xml = 'Layouts/layout.xml') {
        $this->dice = $dice;
        $this->static_dir = $static_dir;
        $this->layout_xml = $layout_xml;
    }

    public function find(array $route) {
        $json_config = json_decode(file_get_contents($this->static_dir . '/static.json'), true);
        $config = $json_config;
        foreach ($route as $part) {
            if (!isset($config[$part])) return false;
            $config = $config[$part];
        }

        if (empty($config)) return false;

        $model = (object) $config;

        $view = $this->dice->create('Transphporm\\Builder', [$this->layout_xml, $this->static_dir . '/static.tss']);

        return new \Level2\Router\Route($model, $view, NULL, getcwd());
    }
}

?>
