<?php

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
        header("Location:index.php?action=login");
        $data = "";
        $VIEW = "./view/Login.phtml";
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

            if (UserModel::login($username, $password) == 1) {
                $_SESSION["IsLogined"] = True;
                $_SESSION["UserName"] = $username;
                header("Location:index.php");
            }
             else {
                $data = "Thông tin đăng nhập bị sai, nhập lại thông tin !!!";
                $VIEW = "./view/Login.phtml";
            }
        } else {
            $data = "";
            $VIEW = "./view/Login.phtml";
        }
        require("./template/main.phtml");
    }
}
