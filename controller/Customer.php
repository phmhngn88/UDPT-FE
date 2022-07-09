<?php

require_once('API.php');

class CustomerController
{
    public function updateCustomerInfo()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        if (count($_POST) > 0 && $_SESSION["role"] == "customer") {
            $API = new API();
            $url = "http://localhost:3000/api/customers/shipping-info";
            $method = "POST";
            $payload = array();

            $phone = $_POST["phone"];
            $address = $_POST["address"];

            $payload = array(
                "phone" => $phone, "address" => $address
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
                $VIEW = "./view/Customer/CustomerUpdate.phtml";
            }
            require("./template/main.phtml");

        }elseif ($_SESSION["role"] == "shop"){
            $role = $_REQUEST['role'];
            $data = "Đang ở trong update Shop";
            $VIEW = "./view/Customer/CustomerUpdate.phtml";
            require("./template/main.phtml");
        }else{
            $data = "Đang ở trong update Shop";
            $role = "shop";
            $VIEW = "./view/Customer/CustomerUpdate.phtml";
            require("./template/main.phtml");
        }

    }

    public function searchProduct()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $API = new API();
        $url = "http://localhost:3000/api/products/search";
        $method = "GET";
        $payload = array();

        $page = 1;
        $size = 10;
        $keyword = "";
        $payload = array(
            "page" => $page, "size" => $size, "keyword" => $keyword
        );
        $result = $API->CallAPI($method, $url, $payload);
        $data = $result->data;

        $VIEW = "./view/Product/SearchProduct.phtml";
        require("./template/main.phtml");
    }

    public function addToCart()
    {

    }

    public function cart()
    {
        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

}
