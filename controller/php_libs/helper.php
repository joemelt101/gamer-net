<?php
	require_once('controller/php_libs/session.php');
    require_once("model/DBConnection.php");
	require_once('model/model_interface.php');
    
    

    function generateHash($string)
    {
        for ($i = 0; $i < 50; $i++)
        {
            $string = hash('sha256', $string);
        }
        return $string;
    }
    function login($uname, $password)
    {
        $user = User::doLogin($uname, $password);
        if (!$user)
        {
            echo "<p>Username or password is invalid.</p>";
        }
        else
        {
            $_SESSION['user'] = $user->getUID();
            redirect("dashboard");
        }
    }

    function getDistance($zip1, $zip2)
    {
        $json = explode(":", file_get_contents("https://www.zipcodeapi.com/rest/1kLviFVVGgQuzF4GzxpQCFlh12iFQfUSzGnSliN1zEw9jBPS8fJKU52V7kAYAvQ9/distance.json/" . $zip1 . "/" . $zip2 . "/mile"));
        $json = explode("}", $json[1]);
        return $json[0];
    }

    function getGenderString($genderType, $needLabel)
    {
        $gender = "";
        if ($needLabel)
            $gender = "Gender: ";
        switch ($genderType)
        {
            case 0:
                $gender .= "Male";
                break;
            case 1:
                $gender .= "Female";
                break;
            case 2:
                $gender .= "Other";
                break;
            default: // default is don't display, so a display string isn't necessary
                $gender = "";
                break;
        }
        return $gender;
    }
    function getStatusString($status)
    {
        $statusString;
        switch($status)
        {
            case 0:
                $statusString = "Offline";
                break;
            default:
                $statusString = "Online";
                break;
        }
        return $statusString;
    }
    
    function getFriends($user)
    {
        $friends = NULL; // will contain objects with all friend attributes
        // we know user will be set before this function is ever called
// gets all friend ids in the form of an array
        $friendIds = $user->getFriends();
        $pending = NULL;
        $blocked = NULL; // will contain objects with blocked user attributes
     //   echo "hello1";
        
        foreach($friendIds as $fid => $type)
        {
            
            if ($type != 4) // this is a user that blocked you, skip
            {
            //    echo $fid;
                $fUser = User::loadByID($fid);
                
                $friend = new stdClass();
                $friend->id = $fUser->getUID();
                $friend->username = $fUser->getUsername();
                $friend->alias = $fUser->getAlias();
                $friend->age = $fUser->getAge();
                $friend->gender = getGenderString($fUser->getGender());
                
                $friend->status = getStatusString($fUser->getOnlineStatus());
                $friend->location = $fUser->getLocation(); // array containing city, state, zip code
                if ($type != 3)
                {
                    
                    switch($type)
                    {
                        case 0:
                            $friend->type = "pending request";
                            $pending[] = $friend;
                            break;
                        case 1:
                            $friend->type = "wants to be friends";
                            $pending[] = $friend;
                            break;
                        default: // currently friends
                            $friend->type = "";
                            $friends[] = $friend;
                            break;
                    }
                    
                }
                else
                {
                    $friend->type = "currently blocked";
                    $blocked[] = $friend;
                }
            }
        }
        
        if ($pending != NULL) // if user has pending friends, append to beginning of list
        {
            if ($friends != NULL)
                $friends = array_merge($pending, $friends);
            else
                $friends = $pending;
        }
        if ($blocked != NULL) // if this user has blocked 'friends', append them to end of list
        {
            if ($friends != NULL)
                $friends = array_merge($friends, $blocked);
            else
                $friends = $blocked;
        }
        return $friends;
    }
?>
