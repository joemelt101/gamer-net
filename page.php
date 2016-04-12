<?php
    require_once("helper.php");
	$page = empty($_GET['page']) ? "index" : $_GET['page'];
	
	$contentUrl = "view/" . $page . ".php";
	require_once $contentUrl;
?>
