<?php
session_start();

require_once("./controller/Login.php");
require_once("./controller/Register.php");
require_once("./controller/Home.php");
require_once("config/dbconnect.php");

$action = "";
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

switch ($action) {
    case "error":
        $controller = new LoginController();
        $controller->unauthorized_page();
        break;
    case "logout":
        $controller = new LoginController();
        $controller->logout();
        break;
    case "login":
        $controller = new LoginController();
        $controller->login();
        break;
    case "register":
        $controller = new RegisterController();
        $controller->register();
        break;

    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
