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
                        if ($newPass == $oldPass)
                        {
                            
                        }
                    }
                }
            }
        }
        
        return $data;
    }
}
?>