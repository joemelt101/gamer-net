<?php
    require_once('controller/php_libs/helper.php');
	
	if (!empty($_GET['page']))
    {
        $page = $_GET['page'];
        $contentUrl = "view/views/" . $page . "_page.php";
        if (!file_exists($contentUrl))
            $contentUrl = "view/views/404.html";
        else
        {
            require_once("controller/controllers/" . $page . "_controller.php");
            $controller = new Controller();
            $data = $controller->getData();
        }
        $relativePath = getRelativePath();
        require_once($contentUrl);
    }
?>
