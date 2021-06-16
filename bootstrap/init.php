<?php

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/");
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "helpers/helpers.php";


$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$request = new App\Core\Request();



include BASE_PATH . "routes/web.php";

// include BASE_PATH . "App/Middleware/GlobalMiddleware.php";


