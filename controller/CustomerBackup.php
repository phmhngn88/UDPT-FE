<?php

require_once('API.php');
class CustomerBackupController
{


    public function viewStore()
    {

        $VIEW = "./view/CustomerBackup/ListShop.phtml";
        $role = "";
        require("./template/main.phtml");
    }

    public function listStore()
    {
        $page = $_POST["page"];
        $size = $_POST["size"];
        $search = $_POST["search"];


        $payload = array(
            "page" => $page,
            "size" => $size,
            "search" => $search,
        );

        $getData = $this->getStores($payload);
        $data = $getData->data->shops;
        $total = $getData->data->shopCount;
        $currentPage = $getData->data->page;

        $VIEW = "./view/CustomerBackup/ListShopAJAX.phtml";
        require($VIEW);
    }



    private function getStores($payload)
    {
        $API = new API();
        $url = "http://localhost:3000/api/shops/listShop";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);

        return $result;
    }

    public function listProduct()
    {
        $limit = $_POST["limit"];
        $page = $_POST["page"];
        $shop_id = $_POST["shopId"];
        $search = $_POST["search"];
        $payload = array(
            "limit" => $limit,
            "page" => $page,
            "shop_id" => $shop_id,
            "search" => $search,
        );

        $getData = $this->getProduct($payload);
        $data = $getData->data->response;
        $total = $getData->data->totalItems;
        $currentPage = $getData->data->page;

        $VIEW = "./view/CustomerBackup/ListProductAjax.phtml";
        require($VIEW);
    }

    private function getProduct($payload)
    {
        $API = new API();
        $url = "http://localhost:3000/api/products/cusGetAllProductByShop";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);

        return $result;
    }

    public function viewListProduct()
    {

        $VIEW = "./view/CustomerBackup/ListProduct.phtml";
        $role = "";
        $id = $_REQUEST["id"];
        require("./template/main.phtml");
    }

    public function cart()
    {

        $API = new API();
        $ids = "";
        if (isset($_SESSION["products"])) {
            $ids = $_SESSION["products"];
        }
        $url = "http://localhost:3000/api/products/cusGetAllByIds?ids=$ids";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);

        $data = $result->data;

        $url = "http://localhost:3000/api/payments";

        $result = $API->CallAPI($method, $url, null);

        $payments = $result->data;
        $VIEW = "./view/CustomerBackup/Cart.phtml";
        $role = "";


        require("./template/main.phtml");
    }

    public function addProductToCart()
    {
        $id = $_POST["id"];
        if ($id != null) {
            $ids = "";
            if (isset($_SESSION["products"])) {
                $ids = $_SESSION["products"];
            }
            $ids = "$ids,$id,";

            $_SESSION["products"] = $ids;
        }

        echo $id;
    }
}
