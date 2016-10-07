<?php
namespace MVC\Model;
class Filter implements Filterable {
    protected $maphper;
    protected $filter = [];

    public function __construct(\Maphper\Maphper $maphper) {
        $this->maphper = $maphper;
    }

    public function set_filter($filter) {
        $this->filter = $filter;
    }

    public function getData() {
        return $this->maphper->filter($this->filter);
    }
}

?>
