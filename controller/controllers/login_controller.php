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
        {   $captcha=$_POST['g-recaptcha-response'];
            
            if(!$captcha){
              echo "<script type='text/javascript'>alert('Be sure to check captcha!')</script>";
              return NULL;
            }
 
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeoVx8TAAAAAIY1F5zESiQdGQ_XL3H1RUGS7VuP&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
 
            if($response.success==false)
            {
              echo "Hey, Spammer! I'm Using Google reCAPTCHA. Get Out, Plz!";
            }
            else
            {
              echo 'Welcome, User!';
            }
                if (isset($_POST['username'], $_POST['password']))
                {
                    $uname = $_POST['username'];
                    $password = $_POST['password'];

                    login($uname, $password);
                }
        }   //end if login button pressed
    }   //end public function __construct()

    public function getData()
    {
        return NULL;
    }
} //end class

?>
