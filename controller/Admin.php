<?php

require_once('API.php');
class AdminController
{

    public function index()
    {  
        $payload = null;
        $c1 = $this->getReviews();
        $numOfReviews = $c1->data->commentsCount;
        $c2 = $this->getStores($payload);
        $numOfStores = $c2->data->shopCount;
        $c3 = $this->getShippers($payload);
        $numOfShippers = $c3->data->shipperCount;
        $c3 = $this->getCustomers($payload);
        $numOfCustomers = $c3->data->customerCount;

        $VIEW = "./view/Admin/Dashboard.phtml";
        require("./template/admin.phtml");
    }

    public function viewShipper() {

        $VIEW = "./view/Admin/DSNguoiGiaoHang.phtml";
        require("./template/admin.phtml");
    }

    public function listShipper() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"]; 
        $search = $_POST["search"]; 
        

        $payload = array(
            "limit" => $limit,
            "offset" => $offset,
            "search" => $search,
        );

        $getData = $this->getShippers($payload);
        $data = $getData->data->shippers;
        $total = $getData->data->shipperCount;
        $currentPage = ($offset + $limit) / $limit;

        $VIEW = "./view/Admin/DSNguoiGiaoHangAJAX.phtml";
        require($VIEW);
    }

    public function viewStore() {

        $VIEW = "./view/Admin/DSCuaHang.phtml";
        require("./template/admin.phtml");
    }

    public function listStore() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"]; 
        $search = $_POST["search"]; 
        

        $payload = array(
            "limit" => $limit,
            "offset" => $offset,
            "search" => $search,
        );

        $getData = $this->getStores($payload);
        $data = $getData->data->shops;
        $total = $getData->data->shopCount;
        $currentPage = ($offset + $limit) / $limit;

        $VIEW = "./view/Admin/DSCuaHangAJAX.phtml";
        require($VIEW);
    }


    public function viewCustomer() {

        $VIEW = "./view/Admin/DSNguoiMua.phtml";
        require("./template/admin.phtml");
    }

    public function listCustomer() {
         $limit = $_POST["limit"];
        $offset = $_POST["offset"]; 
        $search = $_POST["search"]; 
        

        $payload = array(
            "limit" => $limit,
            "offset" => $offset,
            "search" => $search,
        );

        $getData = $this->getCustomers($payload);
        $data = $getData->data->customers;
        $total = $getData->data->customerCount;
        $currentPage = ($offset + $limit) / $limit;

        $VIEW = "./view/Admin/DSNguoiMuaAJAX.phtml";
        require($VIEW);
    }

    public function viewReview() {
        $VIEW = "./view/Admin/DanhGia.phtml";
        require("./template/admin.phtml");
    }


    public function listReview() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"]; 
        $search = $_POST["search"]; 
        

        $payload = array(
            "limit" => $limit,
            "offset" => $offset,
            "search" => $search,
        );

        $getData = $this->getReviews($payload);
        $data = $getData->data->comments;
        $total = $getData->data->commentsCount;
        $currentPage = ($offset + $limit) / $limit;

        $VIEW = "./view/Admin/DanhGiaAJAX.phtml";
        require($VIEW);

    }

    private function getReviews() {
        $API = new API();
        $url = "http://localhost:3000/api/system-reviews";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);
        
        return $result;
    }

    private function getStores($payload) {
        $API = new API();
        $url = "http://localhost:3000/api/shops";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }


    private function getShippers($payload) {
        $API = new API();
        $url = "http://localhost:3000/api/shippers";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }

    private function getCustomers($payload) {
        $API = new API();
        $url = "http://localhost:3000/api/customers";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }
    
    public function updateShopStatus() {
        $id = $_POST["id"];

        $API = new API();
        $url = "http://localhost:3000/api/shops/update-status/$id";
        $method = "PUT";

        $result = $API->CallAPI($method, $url, null);
        
        return $result;
    }

    public function replyComment() {
        $id = $_POST["id"];
        $content = $_POST["content"];
        echo $content;

        $API = new API();
        $url = "http://localhost:3000/api/system-reviews/reply/$id";
        $method = "POST";

        $payload = array(
            "content" => $content,
        );

        $result = $API->CallAPI($method, $url, $payload);
        
        return $result;
    }

}
