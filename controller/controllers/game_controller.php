<?php

class Controller
{
    public function __construct()
    {
        if (!isset($_GET['game']))
            redirect("404");
    }
    public function getData()
    {
        $data = new stdClass();
        $game = Game::loadByID($_GET['game']);
        if ($game == NULL)
            redirect("404");
        $data->name = $game->getName();
        return $data;
    }
}

?>
