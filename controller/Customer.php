<?php

require_once('API.php');

class CustomerController
{
    public function updateCustomerInfo()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $API1 = new API();
        $url1 = "http://localhost:3000/api/customers/me";
        $method1 = "GET";

        $customerRes = $API1->CallAPI($method1, $url1, null);

        $info = $customerRes->data;
        if (count($_POST) > 0) {
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

            $VIEW = "./view/Customer/CustomerUpdate.phtml";
            require("./template/main.phtml");

        }else{
            $VIEW = "./view/Customer/CustomerUpdate.phtml";
            require("./template/main.phtml");
        }

    }

    public function searchProduct()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $_size = 10;
        $_page = $_GET["page"] ?? 1;
        $_keyword = $_GET["keyword"] ?? "";

        $API = new API();
        $url = "http://localhost:3000/api/products/search";
        $method = "GET";
        $payload = array();

        if (is_null($_page)) $_page = 1;
        $size = $_size;
        $page = $_page;
        $keyword = $_keyword;
        $payload = array(
            "page" => $page, "size" => $size, "keyword" => $keyword
        );
        $result = $API->CallAPI($method, $url, $payload);
        $data = $result->data;

        $total_items = $result->data->total_items;
        $total_page = ceil($total_items/ $size);

        $VIEW = "./view/Product/SearchProduct.phtml";
        require("./template/main.phtml");
    }

    public function addToCart(): void
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $API = new API();
        $url = "http://localhost:3000/api/payment/";
        $method = "GET";
        $payload = array();

        $result = $API->CallAPI($method, $url, null);
        $payments = $result->data;
        $id = $_POST["id"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $name = $_POST["name"];
        if(!empty($_POST["quantity"])) {
            $itemArray = array($id=>array('id'=>$id,
                'name'=>$name,
                'price' => $price,
                'quantity'=>$quantity));

            if(!empty($_SESSION["cart_item"])) {
                if(in_array($id,array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($id == $k) {
                            if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
            $VIEW = "./view/Customer/Cart.phtml";
            require("./template/main.phtml");
        }

        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

    public function cart()
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $API = new API();
        $url = "http://localhost:3000/api/payment/";
        $method = "GET";
        $payload = array();

        $result = $API->CallAPI($method, $url, null);
        $payments = $result->data;
        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

    public function emptyCart() : void
    {
        unset($_SESSION["cart_item"]);
        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

    public function removeItem() : void
    {
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($_GET["id"] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }
        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

    public function createOrder() : void
    {
        $loginController = new LoginController();
        $loginController -> authentication();

        $ids = $_POST["ids"];
        $quantities = $_POST["quantities"];
        $payment_ID = $_POST["payment"];
        if (is_null($payment_ID)) {
            $payment_ID = "62555abfe078c36742dcd866";
        }

        $payload = array();

        $items = [];

        foreach ($ids as $key => $id) {
            array_push($items,(object) [
                'id' => $id,
                'quantity' => (int)$quantities[$key]
            ]);
        };

        $payload = array(
            'items' => $items,
            "payment_ID"=> $payment_ID
        );

        $API = new API();
        $url = "http://0.0.0.0:3000/api/orders";
        $method = "POST";
        $result = $API->CallAPI($method, $url, $payload);

        $data = json_encode($payload);
        $VIEW = "./view/Customer/Cart.phtml";
        require("./template/main.phtml");
    }

    public function productDetail() : void
    {
        $API = new API();
        $product_id = $_GET["id"];
        $url = "http://localhost:3000/api/customers/products/$product_id";
        $method = "GET";
        $result = $API->CallAPI($method, $url, null);
        $data = $result->data;

        $url = "http://localhost:3000/api/reviews/$product_id";
        $reviewsRes = $API->CallAPI($method, $url, null);
        $reviews = $reviewsRes->data;

        $VIEW = "./view/Product/ProductDetail.phtml";
        require("./template/main.phtml");
    }

    public function postReview()
    {
        $content = $_POST["content"];
        $rate = $_POST["rate"];
        $productID = $_POST["productID"];

        $API = new API();
        $url = "http://0.0.0.0:3000/api/reviews/create";
        $method = "POST";
        $payload = array();


        $payload = array(
            "content" => $content, "productID" => $productID, "rate" =>$rate
        );
        $result = $API->CallAPI($method, $url, $payload);

        $VIEW = "./view/Product/ProductDetail.phtml";
        require("./template/main.phtml");
    }

}
