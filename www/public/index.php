<?php

require_once '../vendor/autoload.php';

use App\Router\Router;

session_start();
Router::contentToRender();

?>

