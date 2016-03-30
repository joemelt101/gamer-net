<?php

require_once('libs/helper_lib.php');

$controllerName = 'controllers/' . getCurrentPageName(false) . '_controller.php';

//grab controller from specified file
require_once($controllerName);

//initiate controller
$controller = new Controller();

//allow it to adjust data for view
$data = $controller->grabData();

//tell controller to show the view
require_once($controller->grabViewLocation());

?>