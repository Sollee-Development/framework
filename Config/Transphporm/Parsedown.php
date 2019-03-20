<?php
namespace Config\Transphporm;
class Parsedown implements \Transphporm\TSSFunction {
    private $parsedown;

    public function __construct(\Parsedown $parsedown) {
        $this->parsedown = $parsedown;
    }

    public function run(array $args, \DomElement $element) {
        $this->parsedown->setSafeMode($args[1] ?? true);
        return $this->parsedown->text($args[0]);
    }
}