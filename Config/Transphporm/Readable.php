<?php
namespace Config\Transphporm;
class Readable {
    private function camelCase($val) {
        $words = preg_split('/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/', $val);
        return implode(' ', $words);
    }

    public function readable($val, $splitOnDashes = false) {
        $val = $this->camelCase($val);
        $val = str_replace('_', ' ', $val);
        if ($splitOnDashes) $val = str_replace('-', ' ', $val);
        $val = ucwords($val);
        return $val;
    }
}
