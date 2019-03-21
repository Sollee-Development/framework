<?php

require __DIR__ . '/vendor/autoload.php';

session_start();

date_default_timezone_set('America/New_York');

// Setup cache for Axel
$simpleCache = new \SimpleCache\SimpleCache('./tmp');
// Set up Axel autoloader
$axel = new \Axel\Axel($simpleCache);
$axel = $axel->addModule(new \Axel\Module\PSR4('./Modules/'));
$axel = $axel->addModule(new \Axel\Module\PSR4('./Config/', '\\Config'));
$axel = $axel->addModule(new \Axel\Module\PSR4('./lib/'));
$axel->register();

// Set up Dice
$diceLoaderJson = new Config\Dice\MultJsonFileLoader();
$dice = $diceLoaderJson->load('Config/Dice/Framework.json');
$diceConfig = $dice->create('$config_dice');
$dice = $diceLoaderJson->load($diceConfig->getFiles(), $dice);

$url = !empty($_GET['url']) ? $_GET['url'] : ' ';

// Set up router output
$routerOutput = $dice->create('Config\\RouteOutput');

$output = $routerOutput->find(explode('/', $url));
if (!$output) exit;

// If there are headers, Send them
if (!empty($output->headers)) {
    $routerOutput->sendHeaders($output->headers);
    exit;
}

echo $output->body;
