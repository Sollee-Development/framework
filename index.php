<?php

session_start();

date_default_timezone_set('America/New_York');

// Set up Axel autoloader
require_once "lib/Axel/axel.php";
$axel = new \Axel\Axel;
$axel->addModule(new \Axel\Module\PSR0('./lib/'));
$axel->addModule(new \Axel\Module\PSR0('./Modules/'));
$axel->addModule(new \Axel\Module\PSR0('./Config/', '\\Config'));

// Set up Dice
$diceLoaderJson = new Dice\Loader\Json;
$dice = $diceLoaderJson->load('Config/Dice/Framework.json');

// Set up Router
$router = $dice->create('Level2\\Router\\Router');

$url = !empty($_GET['url']) ? $_GET['url'] : ' ';

try {
    $route = $router->find(explode('/', $url));
}
catch (Exception $e) {
    // If there is no route
    $route = new Level2\Router\Route(null,
        $dice->create('Transphporm\\Builder', ['Layouts/layout.xml', 'html:header[status] { content: 404;}']), null, null);
}
$diceConfig = $dice->create('Config\\Dice');
$config = $dice->create('Config\\Environment');
$newDice = $diceLoaderJson->load($diceConfig->getDiceFiles());
$authorize = class_exists("User\\Model\\Authorize") ? $newDice->create("User\\Model\\Authorize") : null;
if (empty($route->getView())) exit;
$output = $route->getView()->output(['model' => $route->getModel(),
    'request' => $newDice->create("Utils\\Request"), 'url' => explode('/', $url),
    'config' => [
        'environment' => $config,
        'resources' => $dice->create('Config\\Resources')
    ],
    'authorize' => $authorize,
    'params' => isset($_GET['url']) ? $_GET['url'] : '']);
// If there are headers, Send them
if (!empty($output->headers)) {
    foreach ($output->headers as $header) {
        if ($header[0] === 'status') http_response_code($header[1]);
        else if ($header[0] === 'location' && $header[1][0] !== '.')
            header($header[0] . ': ' . $config->getRoot() . $header[1]);
        else header($header[0] . ': ' . $header[1]);
    }
    exit;
}

echo $output->body;
