<?php

class HomeController
{
    public function index()
    {
        $VIEW = "./view/Home.phtml";
        require("./template/main.phtml");
    }
}
