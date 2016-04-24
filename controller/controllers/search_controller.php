<?php

class Controller
{
    public function grabData()
    {
        $object = new StdClass;
        
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
        return "view/views/search_page.php";
    }
}

?>
