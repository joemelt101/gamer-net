<?php
// zero means "until browser is closed"
    session_set_cookie_params(0);
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
        $redirectUrl = getRelativePath() . $page;
        if ($currentPage != $page)
        {
            header("Location: " . $redirectUrl);
            exit;
        }
    }
    function getRelativePath()
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
        
        return $redirectUrl;
    }
/* this function will be called when the user logs out or when the browser is closed */
    function goOffline()
    {
        if (isset($_SESSION['user']))
        {
            $user = User::loadByID($_SESSION['user']);
            $user->setOnlineStatus(0);
        }
    }
?>
