<?php

class HomeController
{
    public function index()
    {
        $nombre = "hola";
        require __DIR__ . "../../views/core/home.php";
    }
}