<?php
namespace Utils;
class MaphperHolder {
    private $maphper;

    public function __construct(\Maphper\Maphper $maphper) {
        $this->maphper = $maphper;
    }

    public function getMaphper() {
        return $this->maphper;
    }
}
