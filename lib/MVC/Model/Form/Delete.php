<?php
namespace MVC\Model\Form;
class Delete implements \MVC\Model\Form {
    protected $maphper;
    public $successful = false;
    public $submited = false;
    public $data;

    public function __construct(\Maphper\Maphper $maphper) {
        $this->maphper = $maphper;
    }

    public function main($data = null) {
        $this->submitted = false;
        $this->data = $this->maphper[$data];
        return true;
    }

    public function submit($data) {
        $this->submitted = true;
        $this->data = $data;
        if (!isset($this->maphper[array_values($data)[0]])) return false;
        unset($this->maphper[array_values($data)[0]]);
        return true;
    }

    public function success() {
        $this->successful = true;
    }
}

?>
