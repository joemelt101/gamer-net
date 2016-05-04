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
        $data->user = User::loadByID($_SESSION['user']);
        $user = $data->user;
        if (isset($_POST['changePassButton']))
        {
            if (isset($_POST['currentPassword']))
            {
                if (isset($_POST['newPassword']))
                {
                    if (isset($_POST['verifyPassword']))
                    {
                        $newPass = $_POST['newPassword'];
                        $verifyPass = $_POST['verifyPassword'];
                        if ($newPass == $verifyPass)
                        {
                            $currentPass = $_POST['currentPassword'];
                            $saltAndHash = $user->getPass();
                            $salt = $saltAndHash[0];
                            $hashPass = $saltAndHash[1];
                            
                            /* user entered their current password correctly
                            proceed with password change
                            */
                            if ($hashPass == generateHash($salt . $currentPass))
                            {
                                if ($user->setPass($newPass))
                                    echo "Password changed successfully.";
                                else
                                    echo "Password changed failed.";
                            }
                        }
                    }
                }
            }
        }
        
        return $data;
    }
}
?>