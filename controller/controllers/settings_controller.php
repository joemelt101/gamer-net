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
    // ensures that the user and location data is up to date with the database
    public function initData()
    {
        $data = new stdClass();
        
        $user = User::loadByID($_SESSION['user']);
        $data->user = $user;
        $data->email = $user->getEmail();
        $data->alias = $user->getAlias();
        $data->age = $user->getAge();
        $data->gender = $user->getGender();
        // makes it so literal <br> won't show up in text area in settings
        $data->about = str_replace("<br>", "\n", $user->getAbout());
        
        $location = Location::loadByID($_SESSION['user']);
        $data->city = $location->getCity();
        $data->state = $location->getState();
        $data->zipcode = $location->getZip();
        return $data;
    }
    public function getData()
    {
        $user = User::loadByID($_SESSION['user']);
        $message = "";
        
        
        /* change user info logic */
        if (isset($_POST['changeUserInfoButton']))
        {
            $alias;
            $email;
            $age;
            $gender;
            $about;
            $city;
            $state;
            $zipcode;
            $location = Location::loadByID($_SESSION['user']);
            $updateFlag = false;
            
            if (!empty($_POST['alias']))
            {
                $alias = $_POST['alias'];
                $updateFlag = true;
            }
            else
                $alias = $user->getAlias();
            if (!empty($_POST['email']))
            {
                $email = $_POST['email'];
                $updateFlag = true;
            }
            else
                $email = $user->getEmail();
            if (!empty($_POST['age']))
            {
                $age = $_POST['age'];
                $updateFlag = true;
            }
            else
                $age = $user->getAge();
            if (!empty($_POST['gender']) || $_POST['gender'] == 0)
            {
                $gender = $_POST['gender'];
                // a radio button will always be set, this prevents uneccessary update in database
                if ($gender != $user->getGender())
                    $updateFlag = true;
            }
            else
                $gender = $user->getGender();
            if (isset($_POST['about']))
            {
                
             //   $about = str_replace("\n", "<br>", $_POST['about']);
                $about = $_POST['about'];
                if (strip_tags($about) != strip_tags($user->getAbout()))
                    $updateFlag = true;
            }
            if (!empty($_POST['city']))
            {
                $city = $_POST['city'];
                $updateFlag = true;
            }
            else
                $city = $location->getCity();
            if (!empty($_POST['state']))
            {
                $state = $_POST['state'];
                $updateFlag = true;
            }
            else
                $state = $location->getState();
            if (!empty($_POST['zipcode']))
            {
                $zipcode = $_POST['zipcode'];
                $updateFlag = true;
            }
            else
                $zipcode = $location->getZip();
          //  echo $alias,$email,$age,$gender,$city,$state,$zipcode;
            
            // if user pressed save changes without anything being changed
            if ($updateFlag)
            {
                if ($user->updateSettings($alias, $email, $age, $gender, $about, $city, $state, $zipcode))
                    $message = "Update successful.";
                else
                    $message = "Update failed.";
            }
            else
                $message = "Nothing to update.";
        }
        
        /* change password logic */
        else if (isset($_POST['changePassButton']))
        {
            if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['verifyPassword']))
            {
                $database = new DBConnection();
                $mysqli = $database->conn;
                
                // filter out dangerous characters (single quotes)
                $currentPass = User::filter($mysqli, $_POST['currentPassword']);
                $newPass = User::filter($mysqli, $_POST['newPassword']);
                $verifyPass = User::filter($mysqli, $_POST['verifyPassword']);
                
                $database->close();
                
                if (empty($currentPass) || empty($newPass) || empty($verifyPass))
                    $message = "One or more password fields was empty, password unchanged.";
                else if ($newPass == $verifyPass)
                {
                    $saltAndHash = $user->getPass();
                    $salt = $saltAndHash[0];
                    $hashPass = $saltAndHash[1];
                            
                    /* user entered their current password correctly
                    proceed with password change
                    */
                    if ($hashPass == generateHash($salt . $currentPass))
                    {
                        if (empty($newPass) || empty($verifyPass))
                            $message = "Empty Password";
                        else if (strlen($newPass) < 6)
                            $message = "Password has a minimum length of 6 characters";
                        else if ($user->setPass($newPass))
                            $message = "Password changed successfully.";
                        else
                            $message = "Password changed failed.";
                    }
                    else
                        $message = "Current password was incorrect.";
                }
                else
                    $message = "Password and verify password are not the same.";
            }
            else
                $message = "All password fields are required to change password.";
            
        }
        
        
        echo $message;
        return $this->initData();
    }
}
?>