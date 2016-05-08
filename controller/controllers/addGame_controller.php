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
        return $data;
    }
    public function getData()
    {
        $user = User::loadByID($_SESSION['user']);
        $message = "";
        
        /* add game */
        if (isset($_POST['addGameButton']))
        {
            $name = $_POST['name'];
            $developer = $_POST['developer'];
            $platform = $_POST['platform'];
            $genre = $_POST['genre'];
            $year = $_POST['year'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $videoID = $_POST['videoID'];
            
            if (Game::addGame($name, $developer, $platform, $genre, $year, $type, $description, $videoID))
            {
                $message = "Game successfully added.";
                $gid = Game::getGameIdForUser($name, $developer, $platform, $year, $type);
                //echo $gid;
                if ($user->addGame($gid) != NULL)
                    $message .= "<br>Game successfully added to your game list.";
            }
            else
                $message = "Game creation failed.";
        }
        
        echo $message;
        return $this->initData();
    }
}
?>