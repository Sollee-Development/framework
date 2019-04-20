<?php
namespace CMS\Model\Form;

use Solleer\Form\{GenericForm, Loadable};

class UpdateImage implements GenericForm, Loadable {
    private $saver;
    private $filesystem;

    public function __construct(SaveImage $saver, \League\Flysystem\Filesystem $filesystem) {
        $this->saver = $saver;
        $this->filesystem = $filesystem;
    }

    public function load($id): self {
        return new self($this->saver->load($id), $this->filesystem);
    }

    public function submit(array $data) {
        $fileName = $this->saver->load($data['site_location'])->getData()['file_name'] ?? null;
//var_dump($data); var_dump($fileName); exit;
        $submittedSaver = $this->saver->submit($data);
        if ($fileName !== null) $this->filesystem->delete($fileName);

        return new self($submittedSaver, $this->filesystem);
    }

    public function getData() {
        return $this->saver->getData();
    }

    public function getErrors(): array {
        return $this->saver->getErrors();
    }

    public function isSubmitted(): bool {
        return $this->saver->isSubmitted();
    }
}