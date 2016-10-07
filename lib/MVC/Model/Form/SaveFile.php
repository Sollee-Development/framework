<?php
namespace MVC\Model\Form;
class SaveFile extends Save {
    protected $uploader;

    public function __construct(\Maphper\Maphper $maphper,
            \Respect\Validation\Rules\AllOf $validator, \Upload\File $uploader = null) {
        $this->uploader = $uploader;
        parent::__construct($maphper, $validator);
    }

    protected function setNewFileName() {
        $newFileName = time() . '-' . $this->uploader->getName();
        $this->uploader->setName($newFileName);
    }

    public function submit($data) {
        $this->submitted = true;
        $this->setNewFileName();
        // Upload File
        try {
            $this->uploader->upload();
        } catch (\Exception $e) {
            $errors = $this->uploader->getErrors();
            return false;
        }
        $data['file_name'] = $this->uploader->getNameWithExtension();
        return parent::submit($data);
    }
}
