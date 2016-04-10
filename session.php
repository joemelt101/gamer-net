<?php
    session_start();
	require_once("model/DBConnection.php");
    
    
    $currentPage = basename($_SERVER['PHP_SELF']);

    function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
    function redirect($page)
    {
        if ($currentPage != $page)
        {
            header("Location: /homer/gamer-net/" . $page);
            exit;
        }
    }

    if ($currentPage == "login.php" && isLoggedIn())
        redirect("dashboard.php");
    else if ($currentPage == "dashboard.php" && !isLoggedIn())
        redirect("login.php");
?>
