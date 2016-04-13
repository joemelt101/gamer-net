<?php
    require_once("../helper.php");
    require_once("../model/User.php");


    function login($uname, $password)
    {
        $user = doLogin($uname, $password);
        if (!$user)
        {
            echo "<p>Username or password is invalid.</p>";
        }
        else
        {
            $_SESSION['user'] = $user->getUID();
            redirect("../dashboard");
        }
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
    else if (isset($_POST['registerButton'])) // register button was pressed
    {
        if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
        $_POST['pass'], $_POST['pass2']))
        {
            if (doRegister() == "successful registration")
            {
                login($_POST['username'], $_POST['pass']);
            }
        }
    }
?>