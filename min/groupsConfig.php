<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

// Set up Axel autoloader
require_once __DIR__ . "/../lib/Axel/axel.php";
$axel = new \Axel\Axel;
$axel->addModule(new \Axel\Module\PSR0(__DIR__ . "/../lib/"));
$axel->addModule(new \Axel\Module\PSR0(__DIR__ . '/../Modules/'));
$axel->addModule(new \Axel\Module\PSR0(__DIR__ . '/../Config/', '\\Config'));

$diceLoaderJson = new Dice\Loader\Json;
$dice = $diceLoaderJson->load(__DIR__ . '/../Config/Dice/Framework.json');
$config = $dice->create('Config\\Resources');
$resources = array(
    'js' => $config->getResource("js"),
    'css' => $config->getResource("css")
);

return $resources;
