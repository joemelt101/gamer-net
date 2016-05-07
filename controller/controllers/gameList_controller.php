<?php
class Controller
{
    public function __construct()
    {
        if (!isset($_GET['user']) && !isset($_GET['game']))
            redirect("404");
    }
    public function getData()
    {
        $data = new stdClass();
        if (isset($_GET['user']))
        {
            $user = User::loadByUsername($_GET['user']);
            if ($user == NULL)
                redirect("404");
        
            if (isset($_POST['removeGame']))
            {
                $user->removeGame($_POST['removeGame']);
                redirect("gameList/" . $user->getUsername());
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
        }
        else if ($_GET['game'])
        {
            $gid = $_GET['game'];
            $game = Game::loadByID($gid);
            $data->gameName = $game->getName();
            $data->gid = $gid;
            $data->users = $game->getUsersPlaying();
        }
        return $data;
    }
}

?>
