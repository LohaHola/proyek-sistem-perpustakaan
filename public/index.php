<?php

use Arya\SistemPerpustakaan\Core\App;

// Load composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the application
$app = new App();



// Run the application
$app->run();