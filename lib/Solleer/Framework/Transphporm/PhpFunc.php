<?php
namespace Solleer\Framework\Transphporm;
class PhpFunc implements \Transphporm\TSSFunction {
    public function run(array $args, \DomElement $element) {
        return call_user_func(...$args);
    }
}
