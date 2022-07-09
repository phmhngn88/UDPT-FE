<?php

require_once('API.php');

class CustomerController
{
    public function ViewProfileInfo()
    {
        $API = new API();
        $url = "http://localhost:3000/api/customers/getProfileInfo";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);

        $data = $result->data;
        if ($result->message != "success") {
            $data = null;
        }

        $VIEW = "view/Customer/Profile_Info.phtml";
        require("./template/main.phtml");
    }
    public function SearchShippingHistory()
    {
        LoginController::authentication();
        $page = $_POST["page"];
        $size = $_POST["size"];
        $order_id = $_POST["order_id"];
        $status = $_POST["status"];
        $from = $_POST["from"];
        $to = $_POST["to"];

        $API = new API();
        $url = "http://localhost:3000/api/orders/getAllByShipper";
        $method = "POST";
        $payload = array(
            "page" => $page,
            "size" => $size,
            "order_id" => $order_id,
            "status" => $status,
            "from" => $from,
            "to" => $to
        );

        $result = $API->CallAPI($method, $url, $payload);
        $data = new PagingRes();

        if ($result->message == "success") {
            $data->data = $result->data->items;
            $data->total = $result->data->total_items;
            $data->page = $page;
        }

        $VIEW = "view/Shipper/ShippingHistoryAJAX.phtml";
        require($VIEW);
    }

    public function ShippingOrderDetail()
    {
        LoginController::authentication();
        $id = $_REQUEST["id"];


        $API = new API();
        $url = "http://localhost:3000/api/orders/getDetailByShipper?id=$id";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);

        $data = $result->data;
        if ($result->message != "success") {
            $data = null;
        }

        $VIEW = "view/Shipper/Shipper_OrderDetail.phtml";
        require("./template/main.phtml");
    }

    public function DeliveringOrder()
    {
        LoginController::authentication();

        $API = new API();
        $url = "http://localhost:3000/api/orders/getDeliveringOrderByShipper";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);

        $data = $result->data;
        if ($result->message != "success") {
            $data = null;
        }

        $VIEW = "view/Shipper/Shipper_OrderDetail.phtml";
        require("./template/main.phtml");
    }
}
