<?php

require_once "autoloaders.php";

$dice = new \Dice\Dice();
$dice = $dice->addRules(__DIR__ . '/Config/Dice/Framework.json');
$minifyJs = $dice->create('$js_minify');
$minifyCss = $dice->create('$css_minify');

$js = $minifyJs->minify("resources/js.min.js");
$css = $minifyCss->minify("resources/css.min.css");

$json = [
    'js' => [$js],
    'css' => [$css]
];

file_put_contents('Layouts/online-files.json', json_encode($json));