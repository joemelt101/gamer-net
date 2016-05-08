<?php

class Controller
{
    private $user;
    private $game;
    private $gid;
    public function __construct()
    {
        if (!isset($_GET['game']))
            redirect("404");
        
        $this->gid = $_GET['game'];
        $this->game = Game::loadByID($this->gid);
        if (isLoggedIn())
        {
            $this->user = User::loadByID($_SESSION['user']);
        }
        if (isset($_POST['gameButton']))
        {
            $action = $_POST['gameButton'];
            //echo $action;


            if ($action == "Add")
            {
                $this->user->addGame($this->gid);
            }
            else if ($action == "Remove")
            {
                $this->user->removeGame($this->gid);
            }
            redirect("game/" . $this->gid);
        }
    }
    public function getData()
    {
        $data = new stdClass();
        
        if ($this->game == NULL)
            redirect("404");
        $game = $this->game;
        $data->gid = $this->gid;
        $data->name = $game->getName();
        $data->developer = $game->getDeveloper();
        $data->platform = $game->getPlatform();
        $data->genre = $game->getGenre();
        $data->year = $game->getYear();
        $data->type = $game->getType();
        $data->description = $game->getDescription();
        $videoID = $game->getVideoID();
        if ($videoID != NULL)
            $data->videoLink = "https://youtube.com/embed/" . $videoID;
        
        if (isLoggedIn())
        {
            $data->inUserGameList = $this->user->doesUserHaveGame($this->gid);
        }
        
        
        $data->numUsers = count($game->getUsersPlaying());
        
        return $data;
    }
}

?>
