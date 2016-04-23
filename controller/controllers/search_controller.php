<?php

class Controller
{
    public function getData()
    {
        $data = NULL;
        
        if (isset($_POST['searchBox']))
        {
            $searchString = $_POST['searchBox'];
            if (isset($_POST['searchType']))
            {
                $data = new stdClass();
                
                $searchType = $_POST['searchType'];
                switch ($searchType)
                {
                    case "userSearch":
                        $data->users = User::searchUser($searchString);
                        break;
                    case "gameSearch":
                        break;
                    default: //location
                        break;
                }
                
                
                
            }
            
        }
        

        
        
        
        
        
        return $data;
    }
}

?>
