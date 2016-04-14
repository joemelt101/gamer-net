<?php

/* not needed
require_once('controller/php_libs/session.php');
require_once('controller/php_libs/helper.php');
*/

class Controller
{
    private $user;
    public function __construct()
    {
        if (!isLoggedIn())
        {
            redirect("login");
        }
        else
        {
            $this->user = User::loadByID($_SESSION['user']);
        }
    }
    public function echoUsername()
    {
        echo $this->user->getUsername();
    }
/*
    public function grabData()
    {
        $object = new StdClass;
       
	if (isLoggedIn() == false)
	{
		redirect("login.php");
	}
 
        //here we access the model to retrieve valid data
        if (isset($_POST['module']))
        {
            
            //'print' module of code
            if ($_POST['module'] == 'print')
            {
                //return the username as the data object
                return $_POST['name'];
            }
            
            //other modules go here to handle different forms
            //the module is set by the 
        }
        
        return "Default";
    }
    
    public function grabViewLocation()
    {
        return "view/views/dashboard_page.php";
    }
    */
}

?>
