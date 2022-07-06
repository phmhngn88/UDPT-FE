<?php

require_once('API.php');
class AdminController
{

    public function index()
    {   
        $VIEW = "./view/Admin/Dashboard.phtml";
        require("./template/admin.phtml");
    }

    public function listShipper() {
        $VIEW = "./view/Admin/DSNguoiGiaoHang.phtml";
        require("./template/admin.phtml");
    }

    public function listStore() {
        $VIEW = "./view/Admin/DSCuaHang.phtml";
        require("./template/admin.phtml");
    }

    public function listCustomer() {
        $VIEW = "./view/Admin/DSNguoiMua.phtml";
        require("./template/admin.phtml");
    }

    public function listReview() {
        $API = new API();
        $url = "http://localhost:3000/api/reviews/list";
        $method = "GET";

        $result = $API->CallAPI($method, $url, $payload);
        
        $data = $result->data->products;

        $VIEW = "./view/Admin/DanhGia.phtml";
        require("./template/admin.phtml");
    }
}
