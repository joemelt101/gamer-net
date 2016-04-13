<?php
    require_once("helper.php");
	$page = empty($_GET['page']) ? "index" : $_GET['page'];
	
	$contentUrl = "view/" . $page . ".php";
	if (!file_exists($contentUrl))
		$contentUrl = "view/404.html";
	require_once $contentUrl;
?>
