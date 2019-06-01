<?php
namespace Solleer\Framework\Router;
class ModulePhp implements \Level2\Router\Rule {
    private $dice;

    public function __construct(\Dice\Dice $dice) {
        $this->dice = $dice;
    }

    public function find(array $route) {
        if (count($route) == 0 || $route[0] == '') return false;
        else if (!class_exists($route[0] . '\\RouterRule')) return false;

        $rule = $this->dice->create($route[0] . '\\RouterRule', [], [$this->dice]);
        return $rule->find($route);
    }
}
