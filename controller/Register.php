<?php

require_once('API.php');

class RegisterController
{
    public function register()
    {
        if (count($_POST) >= 0 && isset($_POST["UserName"]) && isset($_REQUEST["role"])) {
            $username = $_POST["UserName"];
            $password = $_POST["Password"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $role = $_REQUEST["role"];
            $bank_account = $_POST["bank_account"];
          
            $API = new API();
            $url = "http://localhost:3000/api/users/register";
            $method = "POST";
            $payload = array();

            if ($_REQUEST["role"] == "shipper") {
                $full_name = $_POST["full_name"];
                $address = $_POST["address"];
                $identity = $_POST["identity"];
                $work_zone = $_POST["work_zone"];

                $payload = array(
                    "username" => $username, "password" => $password,
                    "email" => $email, "phone" => $phone, "role" => $role, 
                    "bank_account" => $bank_account, "full_name" => $full_name,
                    "address" => $address, "identity" => $identity, "work_zone" => $work_zone
                );
            }

            if ($_REQUEST["role"] == "customer") {
                $full_name = $_POST["full_name"];
                $address = $_POST["address"];
                $identity = $_POST["identity"];

                $payload = array(
                    "username" => $username, "password" => $password,
                    "email" => $email, "phone" => $phone, "role" => $role, 
                    "bank_account" => $bank_account, "full_name" => $full_name,
                    "address" => $address, "identity" => $identity,
                );
            }

            if ($_REQUEST["role"] == "shop") {
                $name = $_POST["name"];
                $location = $_POST["location"];
                $description = $_POST["description"];

                $payload = array(
                    "username" => $username, "password" => $password,
                    "email" => $email, "phone" => $phone, "role" => $role, 
                    "bank_account" => $bank_account, "name" => $name,
                    "location" => $location, "description" => $description,
                );
            }

            $result = $API->CallAPI($method, $url, $payload);

            if ($result->success == true) {
                $_SESSION["IsLogined"] = True;
                $_SESSION["UserName"] = $username;
                $_SESSION["Token"] = $result->data->token;
                header("Location:index.php");
            }
             else {
                $data = $result->message;
                $VIEW = "./view/Register.phtml";
            }
        } else if (isset($_REQUEST["role"])) {
            $role = $_REQUEST['role'];
            $data = "";
            $VIEW = "./view/Register.phtml";
        } else {
            $role = "";
            $data = "";
            $VIEW = "./view/Register.phtml";
        }
        require("./template/main.phtml");
    }
}
