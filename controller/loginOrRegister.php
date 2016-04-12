<?php
    require_once("../helper.php");
    if (isset($_POST['loginButton'])) // login button was pressed
    {
        if (isset($_POST['username'], $_POST['password']))
        {
            $uname = $_POST['username'];
            $password = $_POST['password'];
            
            $user = doLogin($uname, $password);
            if (!$user)
            {
                echo "<p>Username or password is invalid.</p>";
            }
            else
            {
                $_SESSION['user'] = serialize($user);
                redirect("../dashboard");
            }
        }
    }
    else if (isset($_POST['registerButton'])) // register button was pressed
    {
        if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
        $_POST['pass'], $_POST['pass2']))
        {
            echo doRegister();
        }
    }
?>