<?php
namespace MVC\Model;
class FileSort extends Sort {
    protected $filePath;

    public function __construct(\Maphper\Maphper $maphper, $filePath, $sort = null) {
        $this->filePath = $filePath;
        parent::__construct($maphper, $sort);
    }

    public function getFilePath() {
        return $this->filePath;
    }
}
