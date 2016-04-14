<?php
	require_once("../php_libs/session.php");
    require_once("../../model/model_interface.php");

    // update database to tell other users that $user is now offline
    if (isset($_SESSION['user']))
    {
        $user = User::loadByID($_SESSION['user']);
        $user->setOnlineStatus(0);
    }


	session_unset();
	// destroy the session
	session_destroy();
	redirect("../../"); // redirect to landing page
?>
