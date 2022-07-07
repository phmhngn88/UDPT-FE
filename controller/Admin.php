<?php

require_once('API.php');
class AdminController
{

    public function index()
    {  
        $c1 = $this->getReviews();
        $numOfReviews = $c1->data->commentsCount;
        $c2 = $this->getStores();
        $numOfStores = $c2->data->shopCount;
        $c3 = $this->getShippers();
        $numOfShippers = $c3->data->shipperCount;
        $c3 = $this->getCustomers();
        $numOfCustomers = $c3->data->customerCount;

        $VIEW = "./view/Admin/Dashboard.phtml";
        require("./template/admin.phtml");
    }
 
    public function listShipper() {
        $getData = $this->getShippers();
        $data = $getData->data->shippers;

        $VIEW = "./view/Admin/DSNguoiGiaoHang.phtml";
        require("./template/admin.phtml");
    }

    public function listStore() {
        $getData = $this->getStores();
        $data = $getData->data->shops;

        $VIEW = "./view/Admin/DSCuaHang.phtml";
        require("./template/admin.phtml");
    }

    public function listCustomer() {
        $getData = $this->getCustomers();
        $data = $getData->data->customers;

        $VIEW = "./view/Admin/DSNguoiMua.phtml";
        require("./template/admin.phtml");
    }


    public function listReview() {
        $API = new API();
        $url = "http://localhost:3000/api/reviews";
        $method = "GET";

        $result = $this->getReviews();
        
        $data = $result->data->products;

        $VIEW = "./view/Admin/DanhGia.phtml";
        require("./template/admin.phtml");
    }

    private function getReviews() {
        $API = new API();
        $url = "http://localhost:3000/api/reviews";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }

    private function getStores() {
        $API = new API();
        $url = "http://localhost:3000/api/shops";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }


    private function getShippers() {
        $API = new API();
        $url = "http://localhost:3000/api/shippers";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }

    private function getCustomers() {
        $API = new API();
        $url = "http://localhost:3000/api/customers";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }

}
