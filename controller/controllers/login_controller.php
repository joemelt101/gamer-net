<?php

require_once("controller/php_libs/session.php");
require_once("controller/php_libs/helper.php");

class Controller
{

    public function grabData()
    {
        if (isLoggedIn() == true)
        {
            redirect("dashboard.php");
        }

        if (isset($_POST['loginButton'])) // login button was pressed
        {
            if (isset($_POST['username'], $_POST['password']))
            {
                $uname = $_POST['username'];
                $password = $_POST['password'];

                $user = doLogin($uname, $password);
                
                if (!$user)
                {
                    redirect("login.php");
                }
                else
                {
                    $_SESSION['user'] = serialize($user);
                    redirect("dashboard.php");
                }
            }
        }
    }
    
    public function grabViewLocation()
    {
        return "view/views/login_page.php";
    }
}

?>
