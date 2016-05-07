<?php
class Controller
{
    public function __construct()
    {
        if (!isset($_GET['user']))
            redirect("404");
    }
    public function getData()
    {
        $data = new stdClass();
        $user = User::loadByUsername($_GET['user']);
        if ($user == NULL)
            redirect("404");
        
        if (isset($_POST['removeGame']))
        {
            $user->removeGame($_POST['removeGame']);
        }

        $data->games = $user->getGames();
        $data->username = $_GET['user'];
        $data->uid = $user->getUID();
        $data->isLoggedUser = FALSE;
        if (isLoggedIn())
        {
            if ($_SESSION['user'] == $data->uid)
                $data->isLoggedUser = TRUE;
        }
        return $data;
    }
}

?>
