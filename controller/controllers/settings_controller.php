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
        return NULL;
    }
}
?>