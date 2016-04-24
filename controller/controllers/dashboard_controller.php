<?php

class Controller
{
    public function __construct()
    {

    }
    public function getData()
    {
        $data = new stdClass();
        $user = NULL;
        if (!isset($_GET['user'])) //this is the logged in user's dashboard
        {
            // user should not be able to view self dashboard if not logged in
            if (!isLoggedIn())
                redirect("login");
            
            // session variable will be assigned thanks to above control statement
            $user = User::loadByID($_SESSION['user']);
        }
        else // this is a different user's dashboard
            $user = User::loadByUsername($_GET['user']);
        
        if ($user == NULL)
            redirect("404");
        $data->uid = $user->getUID();
        $data->alias = $user->getAlias();
        
        if (!isset($_GET['user']))
            $data->welcome = "Welcome, " . $data->alias . " to your dashboard";
        else
        {
            $data->username = $user->getUsername();
            if ($data->alias != $data->username)
            {
                $data->welcome = $data->alias . " (" . $data->username . ")";
            }
            else
                $data->welcome = $data->alias;
        }
        
        $data->games = $user->getGames();
       // foreach($data->games as $game)
      //      echo $game->getName();
        
        // function located in helper.php
        $data->friends = getFriends($user);
        $data->location = $user->getLocation();
        $data->about = $user->getAbout();
        
        return $data;
    }
}

?>
