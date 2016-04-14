<?php
    class Controller
    {
        private $user;
        public function __construct()
        {
            if (!isLoggedIn())
            {
                redirect("login");
            }
            else
            {
                $this->user = User::loadByID($_SESSION['user']);
            }
        }
        public function updateSettings()
        {
            $user = $this->user;
            $user->getOnlineStatus();
            echo ($user->updateSettings("bob", 0, 25)? "Update was successful.":"Update failed.");
        }
    }
?>
