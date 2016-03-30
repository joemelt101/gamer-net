<?php

//helper function
function getCurrentPageName($withExt = true)
{
    $temp = explode('/', $_SERVER['PHP_SELF']);
    
    if ($withExt)
    {
        //load correct controller
        return $temp[sizeof($temp) - 1];
    }

    $temp = explode('.', $temp[sizeof($temp) - 1]);
    return $temp[0];
}

?>