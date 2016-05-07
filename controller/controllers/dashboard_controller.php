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
        if (isLoggedIn())
        {
            $data->loggedUser = User::loadByID($_SESSION['user']);
        }
        
        if (!isset($_GET['user'])) //this is the logged in user's dashboard
        {
            // user should not be able to view self dashboard if not logged in
            if (!isLoggedIn())
                redirect("login");
            
            // session variable will be assigned thanks to above control statement
            $user = User::loadByID($_SESSION['user']);
        }
        else // this is a different user's dashboard
        {
            $user = User::loadByUsername($_GET['user']);
            if (isLoggedIn())
            {
                if ($data->loggedUser->getUsername() == $user->getUsername())
                    redirect("dashboard");
            }
        }
        
        if ($user == NULL)
            redirect("404");
        $data->uid = $user->getUID();
        
        if (isset($_POST['friendButton']))
        {
            $value = $_POST['friendButton'];
            if ($value == "Send Friend Request")
                $data->loggedUser->requestFriend($data->uid);
            else if ($value == "Cancel Request" || $value == "Remove Friend" || $value == "Unblock")
                $data->loggedUser->removeUser($data->uid);
            else if ($value == "Accept Request")
                $data->loggedUser->acceptFriend($data->uid);
        }
        else if (isset($_POST['blockButton']))
        {
            $data->loggedUser->block($data->uid);
        }
        
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
        $data->about = str_replace("\n", "<br>", $user->getAbout());
        $data->email = $user->getEmail();
        
        $gender = $user->getGender();
        $data->gender = getGenderString($gender); // helper.php
        $data->age = $user->getAge();
        $data->status = getStatusString($user->getOnlineStatus());
        
        return $data;
    }
}

?>
