<?php

class Controller
{
    public function getData()
    {
        $data = NULL;
        
        if (isset($_GET['s']))
        {
            $searchString = $_GET['s'];
            //echo $searchString;

            $data = new stdClass();
            
            if (isset($_GET['type']))
            {
                $searchType = $_GET['type'];
                //echo $searchType;
                switch ($searchType)
                {
                    case "user":
                        $data->users = User::searchUser($searchString);
                        break;
                    case "game":
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
