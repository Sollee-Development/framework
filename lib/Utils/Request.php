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

    private function getGlobal($global, $index = NULL) {
        if (empty($index)) return $GLOBALS[$global];
        else {
            if (isset($GLOBALS[$global][$index])) return $GLOBALS[$global][$index];
            else return null;
        }
    }
}
