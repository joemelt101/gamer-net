<?php

class Controller
{
    public function __construct() {
        
    }
    
    public function getData()
    {
        //$object = new StdClass;
        $data = new StdClass;
        
        //here we access the model to retrieve valid data
        /*if (isset($_POST['module']))
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
        */
        $data = PopularGame::getPopularGames();
        //echo $data->count;
        /*foreach ($data as $echoData) {
            echo $echoData;
            echo "<br>";
        }*/
        return $data;
    }
    
    public function grabViewLocation()
    {
        return "/view/views/landing_page.php";
    }
}

?>