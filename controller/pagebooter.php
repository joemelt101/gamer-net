<?php

//if the controller location is not set
if (!isset($controllerLocation))
{
    //there's a problem
    echo ('<b>Controller location must be set!</b>');
    exit();
}

//grab controller from specified file
require_once($controllerLocation);

//initiate controller
$controller = new Controller();

//allow it to adjust data for view
$data = $controller->grabData();

//tell controller to show the view
require_once($controller->grabViewLocation());

?>