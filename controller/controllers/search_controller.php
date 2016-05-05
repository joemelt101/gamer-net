<?php

class Controller
{
    public function getData()
    {
        $data = NULL;
        
        if (isset($_POST['searchBox']))
        {
            $searchString = $_POST['searchBox'];
            echo $searchString;
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
                        $data->games = Game::searchGame($searchString);
                        break;
                    default: //location
                        $data->locations = Location::searchLocation($searchString);
                        break;
                }
                
                
                
            }
            
        }

    
        
        
        
        return $data;
    }
}

?>
