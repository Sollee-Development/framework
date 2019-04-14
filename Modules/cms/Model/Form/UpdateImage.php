<?php
namespace CMS\Model\Form;
class UpdateImage implements \MVC\Model\Form {
    private $saver;
    private $filesystem;
    public $successful = false;
    public $submitted = false;

    public function __construct(SaveImage $saver, \League\Flysystem\Filesystem $filesystem) {
        $this->saver = $saver;
        $this->filesystem = $filesystem;
    }

    public function main($data) {
        $this->submitted = false;

        $this->saver->main($data);
    }

    public function submit($data) {
        $this->submitted = true;

        $this->saver->main([$data['site_location']]);
        $fileName = $this->saver->getData()->file_name ?? null;

        return $this->saver->submit($data) && $fileName !== null && $this->filesystem->delete($fileName);
    }

    public function success() {
        $this->successful = true;
    }
}