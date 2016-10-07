<?php

namespace MVC\Controller;

class Form {
    private $model;
    private $request;

    public function __construct(\MVC\Model\Form $model, \Utils\Request $request) {
        $this->model = $model;
        $this->request = $request;
    }

    public function submit() {
        if ($this->model->submit($this->request->post() ? $this->request->post() : null) == true) {
            $this->model->success();
        }
    }

    public function main($data = null) {
        $this->model->main($data);
    }
}
