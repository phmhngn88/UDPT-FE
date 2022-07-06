<?php

require_once('API.php');
class LoginController
{
    //add this function at any function of controller which require to authorize
    public static function authentication()
    {
        if (!isset($_SESSION["IsLogined"]) || $_SESSION["IsLogined"] != "true") {
            header("Location:index.php?action=error");
        }
    }
    public function logout()
    {
        unset($_SESSION["IsLogined"]);
        unset($_SESSION["UserName"]);
        unset($_SESSION["Token"]);
        
        header("Location:index.php");
        $data = "";
        $VIEW = "./view/Home.phtml";
        require("./template/main.phtml");

    }

    public function unauthorized_page()
    {
        $VIEW = "./view/Notifications.phtml";
        require("./template/main.phtml");
    }

    public function login()
    {
        if (count($_POST) >= 0 && isset($_POST["UserName"])) {
            $username = $_POST["UserName"];
            $password = $_POST["Password"];
            $API = new API();
            $url = "http://localhost:3000/api/users/login";
            $method = "POST";
            $payload = array(
                "username" => $username, "password" => $password,
            );

            $result = $API->CallAPI($method, $url, $payload);

            if ($result->message == "Success") {
                $_SESSION["IsLogined"] = True;
                $_SESSION["UserName"] = $username;
                $_SESSION["Token"] = $result->data->token;
                $_SESSION["role"] = $result->data->role;
                header("Location:index.php");

            }
             else {
                $data = $result->message;
                $VIEW = "./view/Login.phtml";
            }
        } else {
            $VIEW = "./view/Login.phtml";
            $data = "";
        }
        require("./template/main.phtml");
    }
}
