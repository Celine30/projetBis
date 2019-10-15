<?php

use Project\Router;

require '../vendor/autoload.php';

session_start();

$router= new Router();

$router->display();




