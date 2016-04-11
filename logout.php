<?php
	require_once("session.php");
	session_unset();
	// destroy the session
	session_destroy();
	redirect(""); // redirect to landing page
?>
