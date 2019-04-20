<?php
namespace CMS\Model\Form;

use Solleer\Form\{GenericForm, Loadable};

class SaveImage implements GenericForm, Loadable {
    private $saver;
    private $uploader;
    private $imageCache;
    private $filePath;
    private $submitted = false;
    private $fileErrors = [];

    public function __construct(
        \Solleer\Form\Save $saver,
        \FileUpload\FileUpload $uploader,
        \ImageCache\ImageCache $imageCache,
        string $filePath,
        bool $submitted = false,
        array $fileErrors = []
    ) {
        $this->saver = $saver;
        $this->uploader = $uploader;
        $this->imageCache = $imageCache;
        $this->filePath = $filePath;
        $this->submitted = $submitted;
        $this->fileErrors = $fileErrors;
    }

    public function load($id): self {
        return new self($this->saver->load($id), $this->uploader, $this->imageCache, $this->filePath, $this->submitted);
    }

    public function submit(array $data): self {
        // Upload File
        list($files) = $this->uploader->processAll();
        $uploadedFile = $files[0]; // Only supports uploading a single file
        $errors = [];
        if (!$uploadedFile->completed) $errors[] = $uploadedFile->error;
        $data['file_name'] = $uploadedFile->getFilename();

        if (!empty($errors)) return new self($this->saver, $this->uploader, $this->imageCache, $this->filePath, true, $errors);

        // Get cached file
        $uploadedFilePath = $this->filePath . '/' . $data['file_name'];
        $cachedFileName = explode('/', $this->imageCache->cache($uploadedFilePath));
        $cachedFileName = $cachedFileName[count($cachedFileName)-1];

        // Delete larger file
        if ($data['file_name'] !== $cachedFileName) unlink($uploadedFilePath);
        else unlink($this->imageCache->cached_filename);

        // Save result
        $data['file_name'] = $cachedFileName;
        $submittedSaver = $this->saver->submit($data);

        return new self($submittedSaver, $this->uploader, $this->imageCache, $this->filePath, true);
    }

    public function getData() {
        return $this->saver->getData();
    }

    public function getErrors(): array {
        return array_merge($this->fileErrors, $this->saver->getErrors());
    }

    public function isSubmitted(): bool {
        return $this->submitted;
    }
}