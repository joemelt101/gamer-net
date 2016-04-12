<?php
    session_start();
	require_once("model/DBConnection.php");
    
    
    $currentPage = basename($_SERVER['PHP_SELF']);

    function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    /*
        redirect to $page if not already on $page
    */
    function redirect($page)
    {
		$urlPath = $_SERVER['PHP_SELF'];
		$currentPage = basename($urlPath);


        $urlPieces = explode("/", $urlPath);
        $length = count($urlPieces) - 1;
        
        if ($page == '' && $currentPage != 'index.php')
            $length = 3;
        
        
        /* this allows website to function redirects regardless of what folder
        it resides in on the vm server
        */
        $redirectUrl = '';
        for ($i = 0; $i < $length; $i++)
            $redirectUrl .= $urlPieces[$i] . '/';
  
		$redirectUrl .= $page;
        if ($currentPage != $page)
        {
            header("Location: " . $redirectUrl);
            exit;
        }
    }

    /* prevent user from going to dashboard.php unless logged in
    prevent user from going to login.php if already logged in
    */
    if ($currentPage == "login" && isLoggedIn())
        redirect("dashboard");
    else if ($currentPage == "dashboard" && !isLoggedIn())
        redirect("login");
?>
