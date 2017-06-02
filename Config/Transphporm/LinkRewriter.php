<?php
namespace Config\Transphporm;
class LinkRewriter implements \Transphporm\TSSFunction {
    public function run(array $args, \DomElement $element) {
        $link = $args[0];
        $rewriteMap = $args[1];
        $search = array_keys($rewriteMap);
        $replace = array_values($rewriteMap);

        return str_replace($search, $replace, $link);
    }
}
