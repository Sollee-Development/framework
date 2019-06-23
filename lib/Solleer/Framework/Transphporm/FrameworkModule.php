<?php
namespace Solleer\Framework\Transphporm;
class FrameworkModule implements \Transphporm\Module {
    public function load(\Transphporm\Config $config) {
        $functionSet = $config->getFunctionSet();
        $functionSet->addFunction('link-rewrite', new LinkRewriter());
        $functionSet->addFunction('parsedown', new Parsedown(new \Parsedown()));
        $functionSet->addFunction('php', new PhpFunc());
        $config->registerFormatter(new Readable);
    }
}
