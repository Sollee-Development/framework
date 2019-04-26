<?php

namespace Config;

use MatthiasMullie\Minify as Minifier;


class Minify {
    private $minifier;

    public function __construct(Minifier\Minify $minifier, array $files) {
        $this->minifier = clone $minifier;
        foreach ($files as $file) $this->minifier->add($file);
    }

    public function minify($path) {
        $this->minifier->gzip($path);
    }
}