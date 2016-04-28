<?php
class Controller
{
    public function __construct()
    {
        if (isLoggedIn())
        {
            redirect("dashboard");   
        }
        if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
        $_POST['pass'], $_POST['pass2']))
        {
            
            $registerMessage = User::doRegister();
            if ($registerMessage == "successful registration")
            {
                login($_POST['username'], $_POST['pass']);
            }
            else
                echo $registerMessage;
        }
    }
    public function getData()
    {   
        return NULL;
    }
}

?>
