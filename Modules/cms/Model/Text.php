<?php

namespace CMS\Model;

class Text {
    private $model;

    public function __construct(\ArrayAccess $model) {
        $this->model = $model;
    }

    public function getText($index) {
        return $this->model[$index]->markdown ?? '';
    }
}