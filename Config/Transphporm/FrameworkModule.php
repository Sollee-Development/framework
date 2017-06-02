<?php
namespace Config\Transphporm;
class FrameworkModule implements \Transphporm\Module {
    public function load(\Transphporm\Config $config) {
        $functionSet = $config->getFunctionSet();
        $functionSet->addFunction('link-rewrite', new LinkRewriter());
        $config->registerFormatter(new Readable);
    }
}
