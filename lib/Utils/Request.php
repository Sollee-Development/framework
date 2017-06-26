<?php
namespace Utils;
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

    public function server($selector = NULL) {
        return $this->getGlobal('_SERVER', $selector);
    }

    public function files($selector = NULL) {
        return $this->getGlobal('_FILES', $selector);
    }

    private function getGlobal($global, $index = NULL) {
        if ($index === null) return $GLOBALS[$global];
        else return $GLOBALS[$global][$index] ?? null;
    }
}
