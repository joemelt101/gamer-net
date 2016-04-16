<?php
    session_start();
    

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
?>
