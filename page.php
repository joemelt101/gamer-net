<?php
    require_once('controller/php_libs/helper.php');
	
	if (!empty($_GET['page']))
    {
        $page = $_GET['page'];
        $contentUrl = "view/views/" . $page . "_page.php";
        $relativePath = getRelativePath();
        if (!file_exists($contentUrl))
            $contentUrl = "view/views/404.html";
        else
        {
            require_once("controller/controllers/" . $page . "_controller.php");
            $controller = new Controller();
            $data = $controller->getData();
        }
        
        require_once($contentUrl);
    }
?>
<!--
this logs out the user on window close, the problem is it triggers when
switching pages also, so brute force fix would be to go in every controller
and setOnineStatus(1) if the user's session variable exists
<script>
    window.onbeforeunload = function()
    {
        <?php/*
            if (isset($_SESSION['user']))
            {
                $user = User::loadByID($_SESSION['user']);
                $user->setOnlineStatus(0);
            }*/
        ?>
    }
</script>
-->
