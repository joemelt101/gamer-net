<?php
class Controller
{
    public function __construct()
    {   $captcha=$_POST['g-recaptcha-response'];
        if (isLoggedIn())
        {
            redirect("dashboard");   
        }

        if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
        $_POST['pass'], $_POST['pass2']))
        {   if(!$captcha){
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
              echo 'Welcome, Registrant!';
            }
            
            $registerMessage = User::doRegister();
            if ($registerMessage == "successful registration")
            {
                $user = User::loadByUsername($_POST['username']);
                $user->addLocation('', '', 0);
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
