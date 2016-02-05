<?php

namespace MVC\Model;

interface Form {
    public function submit($data);
    public function success();
}

?>
