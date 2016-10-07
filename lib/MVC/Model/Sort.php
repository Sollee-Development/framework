<?php
namespace MVC\Model;
class Sort extends Filter {
    protected $sort = '';

    public function __construct(\Maphper\Maphper $maphper, $sort = null) {
        $this->sort = $sort;
        parent::__construct($maphper);
    }

    public function getData() {
        return parent::getData()->sort($this->sort);
    }
}
