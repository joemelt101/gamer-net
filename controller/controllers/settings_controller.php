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
        public function updateUserSettings()
        {
            $user = $this->user;
            $user->getOnlineStatus();
            echo ($user->updateSettings("bob", 0, 25)? "Update was successful.":"Update failed.");
        }
        public function displayContactInfo()
        {
            $contactInfo = $this->user->getContactInfo();
            if (!empty($contactInfo))
            {
                /*
                contact info is an array of string arrays,
                each string array has 2 elements
                element 0 is the platform
                element 1 is the username
                
                so a key of contact info references a platform and username
                */
                foreach($contactInfo as $id => $info)
                {
                    echo $id . ": " . $info[0] . " = " . $info[1] . "<br>";
                }
            }
        }
        public function deleteContactInfo($cid)
        {
            if ($this->user->deleteContactInfo($cid))
                echo "success";
            else
                echo "failure";
            
            echo "<br>";
        }
        public function addContactInfo($platform, $username)
        {
            if ($this->user->addContactInfo($platform, $username))
                echo "success";
            else
                echo "failure";
            
            echo "<br>";
        }
        public function updateContactInfo($cid, $platform, $username)
        {
            if ($this->user->updateContactInfo($cid, $platform, $username))
                echo "success";
            else
                echo "failure";
            
            echo "<br>";
        }
        public function updatePass($oldPass, $newPass)
        {
            $user = $this->user;
            $saltAndHash = $user->getPass();
            $localHash = generateHash($saltAndHash[0] . $oldPass);
            if ($localHash != $saltAndHash[1])
                return "Old password was incorrect, password did not change.";
            else
            {
                if ($user->setPass($newPass))
                    return "Password successfully changed.";
                else
                    return "An error occurred, password was not changed.";
            }
        }
    }
?>
