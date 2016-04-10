<?php
	require_once("helper.php");
    mt_srand(); // random number generator based on time?
    $salt = mt_rand();
    echo $salt . "<br>";
	echo generateHash($salt . "bob");

    $urlPieces = explode("/", $_SERVER['PHP_SELF']);
    $length = count($urlPieces) - 1;


    $redirectUrl = '';
    for ($i = 0; $i < $length; $i++)
        $redirectUrl .= $urlPieces[$i] . '/';
    
    $redirectUrl .= "dashboard.php";

    echo $redirectUrl;
?>