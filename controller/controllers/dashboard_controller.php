<?php

/* not needed
require_once('controller/php_libs/session.php');
require_once('controller/php_libs/helper.php');
*/

class Controller
{
    public function __construct()
    {
        if (!isLoggedIn())
        {
            redirect("login");
        }
    }
    public function getData()
    {
        $data = new stdClass();
        $user = User::loadByID($_SESSION['user']);
        $data->username = $user->getUsername();
        $data->games = Game::getGames();
        
        return $data;
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
