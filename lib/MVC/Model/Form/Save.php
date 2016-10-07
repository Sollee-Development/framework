<?php
namespace MVC\Model\Form;
class Save implements \MVC\Model\Form {
    protected $maphper;
    protected $validator;
    public $successful = false;
    public $submited = false;
    public $data;

    public function __construct(\Maphper\Maphper $maphper, \Respect\Validation\Rules\AllOf $validator = null) {
        $this->maphper = $maphper;
        $this->validator = $validator;
    }

    public function main($data = null) {
        $this->submitted = false;
        $this->data = $this->maphper[$data[0]];
        return true;
    }

    public function submit($data) {
        $this->submitted = true;
        $this->data = (object) $data;
        if (!$this->validator->validate((array) $this->data)) return false;
        $this->maphper[] = $this->data;
        return true;
    }

    public function success() {
        $this->successful = true;
    }
}

?>
