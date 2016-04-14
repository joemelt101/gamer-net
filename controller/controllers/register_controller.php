<?php

require('controller/php_libs/helper.php');

class Controller
{
    public function grabData()
    {
        if (isLoggedIn() == true)
        {
            redirect("dashboard.php");   
        }
        
        if (isset($_POST['registerButton'])) // register button was pressed
        {
            if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
            $_POST['pass'], $_POST['pass2']))
            {
                echo doRegister();
                redirect("dashboard.php");
            }
            else
            {
                //TODO: repopulate appropriate fields
                redirect("register.php");   
            }
        }
        
        return "Default";
    }
    
    public function grabViewLocation()
    {
        return "view/views/register_page.php";
    }
}

?>
