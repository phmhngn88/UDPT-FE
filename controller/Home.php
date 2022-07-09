<?php

class HomeController
{
    public function index()
    {
        $VIEW = "./view/Home.phtml";
        $role = "";
        if (isset($_SESSION["role"])) {
            $role = $_SESSION["role"];
        }
        require("./template/main.phtml");

    }
}
