<?php
	require_once("../php_libs/session.php");
    require_once("../../model/model_interface.php");

    // update database to tell other users that $user is now offline
    goOffline();


	session_unset();
	// destroy the session
	session_destroy();
	redirect("../../"); // redirect to landing page
?>
