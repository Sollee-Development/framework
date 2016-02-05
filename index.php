<?php

session_start();

// Set up Axel autoloader
require_once "lib/axel/axel.php";
$axel = new \Axel\Axel;
$axel->addModule(new \Axel\Module\PSR0('./lib/'));
$axel->addModule(new \Axel\Module\PSR0('./Config/', '\\Config'));

$diceLoaderJson = new Dice\Loader\Json;
$dice = $diceLoaderJson->load('Config/Dice/Config.json');

$router = $dice->create('Level2\\Router\\Router');
$router->addRule($dice->create('Config\\Router\\StaticPages', [$dice]));
$router->addRule($dice->create('Config\\Router\\ModuleJson', [$dice]));

$url = !empty($_GET['url']) ? $_GET['url'] : 'index';
$route = $router->find(explode('/', $url));

$output = $route->getView()->output(['model' => $route->getModel()]);
// If there are headers, Send them
if (!empty($output->headers)) {
    foreach ($output->headers as $header) {
        if ($header[0] === 'status') http_response_code($header[1]);
        else header($header[0] . ': ' . $header[1]);
    }
    exit;
}

echo $output->body;


?>
