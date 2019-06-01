<?php
namespace Solleer\Framework\Transphporm;
class FrameworkModule implements \Transphporm\Module {
    public function load(\Transphporm\Config $config) {
        $functionSet = $config->getFunctionSet();
        $functionSet->addFunction('link-rewrite', new LinkRewriter());
        $functionSet->addFunction('parsedown', new Parsedown(new \Parsedown()));
        $config->registerFormatter(new Readable);
    }
}
