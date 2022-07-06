<?php

require_once('API.php');

class ShopController
{
    public function updateShop()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        if (count($_POST) > 0 && $_SESSION["role"] == "shop") {
            $API = new API();
            $url = "http://localhost:3000/api/shops/update";
            $method = "POST";
            $payload = array();

            $name = $_POST["name"];
            $location = $_POST["location"];
            $description = $_POST["description"];
            $bank_account = $_POST["bank_account"];
            $phone = $_POST["phone"];

            $role = $_REQUEST["role"];
            $payload = array(
                "phone" => $phone, "role" => $role,
                "bank_account" => $bank_account, "name" => $name,
                "location" => $location, "description" => $description,
            );
            $result = $API->CallAPI($method, $url, $payload);
            if ($result->success == true) {
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/Home.phtml";
            }else{
                print_r($payload);
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/updateShop.phtml";
            }
            require("./template/main.phtml");

        }elseif ($_SESSION["role"] == "shop"){
            $role = $_REQUEST['role'];
            $data = "Đang ở trong update Shop";
            $VIEW = "./view/updateShop.phtml";
            require("./template/main.phtml");
        }else{
            $data = "Đang ở trong update Shop";
            $role = "shop";
            $VIEW = "./view/updateShop.phtml";
            require("./template/main.phtml");
        }

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
                // header("Location:index.php");
                $data = "thanhf cong";
                $VIEW = "./view/Login.phtml";
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
