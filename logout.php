<?php
	require_once("session.php");
	session_unset();
	// destroy the session
	session_destroy();
	redirect("index.php"); // redirect to landing page
?>
