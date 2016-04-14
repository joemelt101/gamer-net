<?php
class Controller
{
    private $user;
    
    public function __construct()
    {
        if (!isLoggedIn())
        {
            redirect('login');          
        }
        else
        {
            $this->user = User::loadByID($_SESSION['user']);
        }
    }
    public function listFriends()
    {
        $user->getFriends();
    }
}

?>
