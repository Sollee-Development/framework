<?php
namespace Level2\Core;
class Request {
    public function get($selector = NULL) {
        return $this->getGlobal('_GET', $selector);
    }

    public function post($selector = NULL) {
        return $this->getGlobal('_POST', $selector);
    }

    public function session($selector = NULL) {
        return $this->getGlobal('_SESSION', $selector);
    }

    // Have to use $_SERVER superglobabl because it is not always loaded into $GLOBALS
    public function server($selector = NULL) {
        if ($selector === null) return $_SERVER;
        else return $_SERVER[$selector] ?? null;
    }

    public function files($selector = NULL) {
        return $this->getGlobal('_FILES', $selector);
    }

    private function getGlobal($global, $index = NULL) {
        if ($index === null) return $GLOBALS[$global];
        else return $GLOBALS[$global][$index] ?? null;
    }
}
