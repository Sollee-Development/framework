<?php

namespace Solleer\Misc;

/*
 * May move this to a library if I find more classes to package it with
 */

class IdController {
    public function id(\Maphper\Maphper $model, $id): stdClass {
        return $model[$id];
    }
}