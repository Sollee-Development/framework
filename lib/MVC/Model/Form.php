<?php
namespace MVC\Model;
interface Form {
    public function main($data);
    public function submit($data);
    public function success();
}
