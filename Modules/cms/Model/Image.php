<?php

namespace CMS\Model;

class Image {
    private $model;
    private $filePath;
    private $defaultName;

    public function __construct(\ArrayAccess $model, $filePath, $defaultName = "placeholder.png") {
        $this->model = $model;
        $this->filePath = $filePath;
        $this->defaultName = $defaultName;
    }

    public function getFileName($index) {
        return $this->filePath . '/' . ($this->model[$index]->file_name ?? $this->defaultName);
    }
}