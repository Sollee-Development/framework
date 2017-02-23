<?php

require __DIR__ . '/vendor/autoload.php';

session_start();

date_default_timezone_set('America/New_York');

// Set up Axel autoloader
$axel = new \Axel\Axel;
$axel->addModule(new \Axel\Module\PSR0('./Modules/'));
$axel->addModule(new \Axel\Module\PSR0('./Config/', '\\Config'));
$axel->addModule(new \Axel\Module\PSR0('./lib/'));

// Set up Dice
$diceLoaderJson = new Dice\Loader\Json;
$dice = $diceLoaderJson->load('Config/Dice/Framework.json');

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
