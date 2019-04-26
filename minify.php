<?php

require_once "autoloaders.php";

$dice = new \Dice\Dice();
$dice = $dice->addRules(__DIR__ . '/Config/Dice/Framework.json');
$minifyJs = $dice->create('$js_minify');
$minifyCss = $dice->create('$css_minify');

$minifyJs->minify("resources/js.min.js");
$minifyCss->minify("resources/css.min.css");