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
        $data = new stdClass();
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
        
        $data->friends = getFriends($user);
        return $data;
    }
}

?>
