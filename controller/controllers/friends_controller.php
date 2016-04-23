<?php
class Controller
{
    public function __construct()
    {
        if (!isLoggedIn())
        {
            redirect('login');
        }
    }
    public function getData()
    {
        $friends = NULL; // will contain objects with all friend attributes
        // we know user will be set before this function is ever called
        $user = User::loadByID($_SESSION['user']);
        
        //block duffman2113
       // $user->block(12); 
        
        
        
        if (isset($_POST['Cancel']))
        {
            $user->removeUser($_POST['Cancel']);
        }
        else if (isset($_POST['Accept']))
        {
            $user->acceptFriend($_POST['Accept']);
        }
        else if (isset($_POST['Decline']))
        {
            $user->removeUser($_POST['Decline']);
        }
        else if (isset($_POST['Unfriend']))
        {
            $user->removeUser($_POST['Unfriend']);
        }
        else if (isset($_POST['Unblock']))
        {
            $user->removeUser($_POST['Unblock']);
        }   
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
                $friend->gender = $fUser->getGender();
                $friend->status = $fUser->getOnlineStatus();
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
}

?>
