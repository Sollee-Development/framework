<?php

namespace MVC\Controller;

class Form {
    private $model;

    public function __construct(\MVC\Model\Form $model) {
        $this->model = $model;
    }

    public function submit($data) {
        if ($this->model->submit($data) == true) {
            $this->model->success();
        }
    }
}


?>
