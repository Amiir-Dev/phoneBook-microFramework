<?php
# front controller for

use App\Models\User;

include "bootstrap/init.php";


$router = new \App\Core\Routing\Router();
$router->run();

