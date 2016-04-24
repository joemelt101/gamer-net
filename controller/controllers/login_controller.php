<?php

class Controller
{
    public function __construct()
    {
        if (isLoggedIn())
        {
            redirect("dashboard");
        }

        if (isset($_POST['loginButton'])) // login button was pressed
        {
            if (isset($_POST['username'], $_POST['password']))
            {
                $uname = $_POST['username'];
                $password = $_POST['password'];

                login($uname, $password);
            }
        }
    }
    public function getData()
    {
        return NULL;
    }
}

?>
