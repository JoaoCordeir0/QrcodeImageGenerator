<?php

session_start();

include "./vendor/autoload.php";

use App\routes\Routes;

$router = new Routes();
$router->run($_SERVER['REQUEST_URI']);

// --------------------------- //
// Dev by João Victor Cordeiro //
// --------------------------- //