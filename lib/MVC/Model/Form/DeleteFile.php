<?php
namespace MVC\Model\Form;
class DeleteFile extends Delete {
    protected $file_path;

    public function __construct(\Maphper\Maphper $maphper, $file_path) {
        $this->file_path = $file_path;
        parent::__construct($maphper);
    }

    public function submit($data) {
        $file_name = $this->maphper[$data["id"]]->file_name;
        if (parent::submit($data)) {//var_dump($file_name); exit;
            unlink($this->file_path . $file_name);
            return true;
        }
        else return false;
    }
}
