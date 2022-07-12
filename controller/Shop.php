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

    public function addProduct()
    {
        $loginController = new LoginController();
        $loginController -> authentication();
        if (count($_POST) > 0 && $_SESSION["role"] == "shop") {
            $API = new API();
            $url = "http://localhost:3000/api/shops/insertProduct";
            $method = "POST";
            $payload = array();

            $name = $_POST["name"];
            $description = $_POST["description"];
            $inventory = $_POST["inventory"];
            $unit_price = $_POST["unit_price"];
            $unit = $_POST["unit"];
            $product_type = $_POST["product_type"];
            $role = $_REQUEST["role"];

            $payload = array(
                "name" => $name, "description" => $description,
                "$inventory" => $inventory, "unit_price" => $unit_price,
                "unit" => $unit, "product_type" => $product_type,
            );
            print_r($payload);
            $result = $API->CallAPI($method, $url, $payload);
            if ($result->success == true) {
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/Home.phtml";
            }else{
                print_r($payload);
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/addProduct.phtml";
            }
            require("./template/main.phtml");

        }elseif ($_SESSION["role"] == "shop"){
            $VIEW = "./view/addProduct.phtml";
            require("./template/main.phtml");
        }else{
            $role = "shop";
            $VIEW = "./view/Home.phtml";
            require("./template/main.phtml");
        }
    }

    public function updateProduct()
    {
        $loginController = new LoginController();
        $loginController -> authentication();
        if (count($_POST) > 0 && $_SESSION["role"] == "shop") {
            $API = new API();
            $url = "http://localhost:3000/api/shops/updateProduct";
            $method = "POST";
            $payload = array();


            $name = $_POST["name"];
            $id = $_GET["id"];

            $description = $_POST["description"];
            $inventory = $_POST["inventory"];
            $unit_price = $_POST["unit_price"];
            $unit = $_POST["unit"];
            $product_type = $_POST["product_type"];
            $role = $_REQUEST["role"];

            $payload = array(
                "name" => $name, "description" => $description,
                "inventory" => $inventory, "unit_price" => $unit_price,
                "unit" => $unit, "product_type" => $product_type, "product_id" => $id
            );
            print_r($payload);
            $result = $API->CallAPI($method, $url, $payload);
            if ($result->success == true) {
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/Home.phtml";
            }else{
                print_r($payload);
                $data = "Đang ở trong update Shop";
                $role = "shop";
                $VIEW = "./view/updateProduct.phtml";
            }
            require("./template/main.phtml");

        }elseif ($_SESSION["role"] == "shop"){
            $VIEW = "./view/updateProduct.phtml";
            require("./template/main.phtml");
        }else{
            $role = "shop";
            $VIEW = "./view/Home.phtml";
            require("./template/main.phtml");
        }
    }

    public function AllProductByShop()
    {
        $loginController = new LoginController();
        $loginController -> authentication();
        $VIEW = "./view/shop/ListProduct.phtml";
        require("./template/main.phtml");
    }

    public function listProduct() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"];


        $payload = array(
            "limit" => $limit,
            "offset" => $offset,
        );

        $getData = $this->getProduct($payload);
        $data = $getData->data->products;
        $total = $getData->data->productCount;
        $currentPage = ($offset + $limit) / $limit;

        $VIEW = "./view/Shop/ListProductAjax.phtml";
        require($VIEW);
    }

    private function getProduct($payload) {
        $API = new API();
        $url = "http://localhost:3000/api/products/getProductByShop";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);

        return $result;
    }

    public function UpdateOrderStatus()
    {
        $loginController = new LoginController();
        $loginController -> authentication();
        $id = $_POST["id"];
        $status = $_POST["status"];

        $API = new API();
        $url = "http://localhost:3000/api/orders/update-status";
        $method = "POST";

        $payload = array(
            "order_id" => $id,
            "status" => $status
        );

        $result = $API->CallAPI($method, $url, $payload);
        $data = $result->message;

        if ($result->message == "success") {
            header("Location:index.php?action=shipping-history");
        }


        echo $result->success;
    }

    public function GetNewOrderByShop()
    {
        $loginController = new LoginController();
        $loginController -> authentication();


        $API = new API();
        $url = "http://localhost:3000/api/orders/getNewOrderByShop";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);


        echo json_encode($result);
    }
}
