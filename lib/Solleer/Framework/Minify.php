<?php

namespace Solleer\Framework;

use MatthiasMullie\Minify as Minifier;


class Minify {
    private $minifier;

    public function __construct(Minifier\Minify $minifier, array $files) {
        $this->minifier = clone $minifier;
        foreach ($files as $file) $this->minifier->add($file);
    }

    public function minify($path, $addHash = true) {
        if ($addHash) {
            $md5 = md5($this->minifier->minify());
            $fileExplode = explode('.', $path);
            array_splice($fileExplode, -1, 0, substr($md5, 0, 6));
            $path = implode('.', $fileExplode);
        }

        $this->minifier->gzip($path);
        return $path;
    }
}