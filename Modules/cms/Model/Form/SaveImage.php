<?php
namespace CMS\Model\Form;
class SaveImage implements \MVC\Model\Form {
    private $image_cache;
    private $file_path;
    private $saver;
    private $fileSaver;
    public $successful = false;
    public $submitted = false;

    public function __construct(\MVC\Model\Form\SaveFile $fileSaver, \MVC\Model\Form\Save $saver,
                                \ImageCache\ImageCache $image_cache, $file_path) {
        $this->image_cache = $image_cache;
        $this->file_path = $file_path;
        $this->fileSaver = $fileSaver;
        $this->saver = $saver;
    }

    public function main($data = null) {
        $this->submitted = false;
        $this->saver->main($data);
        return true;
    }

    public function submit($data) {
        $this->submitted = true;
        if (!$this->fileSaver->submit($data)) return false;
        $data = $this->saver->getData();
        $orig_filename = $this->file_path . '/' . $data->file_name;
        $image_path = explode('/', $this->image_cache->cache($orig_filename));
        if ($data->file_name !== $image_path[count($image_path)-1]) unlink($orig_filename);
        else unlink($this->image_cache->cached_filename);
        $data->file_name = $image_path[count($image_path)-1];
        $this->saver->submit((array)$data);
        return true;
    }

    public function success() {
        $this->successful = true;
    }

    public function getData() {
        return $this->saver->getData();
    }
}
