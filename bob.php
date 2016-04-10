<?php
	require_once("helper.php");
    mt_srand(); // random number generator based on time?
    $salt = mt_rand();
    echo $salt . "<br>";
	echo generateHash($salt . "bob");

	echo $_SERVER['PHP_SELF'];
?>
