<?php

require_once('controller/php_libs/helper.php');


class Controller
{
    public function grabData()
    {
        if (isLoggedIn() == false)
        {
            redirect('login.php');          
        }
        
        $object = new StdClass;
        
        return $object;
    }
    
    public function grabViewLocation()
    {
        return "view/views/friends_page.php";
    }
}

?>
