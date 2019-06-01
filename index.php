<?php

require_once "autoloaders.php";

session_start();

date_default_timezone_set('America/New_York');

// Set up Dice
$diceLoaderJson = new Solleer\Framework\Dice\MultJsonFileLoader();
$dice = $diceLoaderJson->load('Config/Dice/Framework.json');
$diceConfig = $dice->create('$config_dice');
$dice = $diceLoaderJson->load($diceConfig->getFiles(), $dice);

$url = !empty($_GET['url']) ? $_GET['url'] : ' ';

// Send push headers for css
$http2push = $dice->create("HTTP2Push\\CookieTrack");
$http2push->sendHeader();

// Set up router output
$routerOutput = $dice->create('Solleer\\Framework\\RouteOutput');
$routerOutput->find(explode('/', $url));