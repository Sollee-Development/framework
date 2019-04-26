<?php

require __DIR__ . '/vendor/autoload.php';

// Setup cache for Axel
$simpleCache = new \SimpleCache\SimpleCache('./tmp');
// Set up Axel autoloader
$axel = new \Axel\Axel($simpleCache);
$axel = $axel->addModule(new \Axel\Module\PSR4('./Modules/'));
$axel = $axel->addModule(new \Axel\Module\PSR4('./Config/', '\\Config'));
$axel = $axel->addModule(new \Axel\Module\PSR4('./lib/'));
$axel->register();