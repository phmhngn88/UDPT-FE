<?php

require_once('API.php');

class ShipperController
{
    public function ViewShippingHistory()
    {
        $role = $_SESSION["role"];
        $VIEW = "view/Shipper/ShippingHistory.phtml";
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
        $role = $_SESSION["role"];

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
        $role = $_SESSION["role"];

        $VIEW = "view/Shipper/Shipper_OrderDetail.phtml";
        require("./template/main.phtml");
    }
    public function HealthHistory()
    {
        LoginController::authentication();
        $role = $_SESSION["role"];

        $VIEW = "view/Shipper/HealthHistory.phtml";
        require("./template/main.phtml");
    }
    public function GetHealthHistory()
    {
        LoginController::authentication();
        $page = $_POST["page"];
        $size = $_POST["size"];
        $from = $_POST["from"];
        $to = $_POST["to"];

        $API = new API();
        $url = "http://localhost:3000/api/shippers/getHealthHistory";
        $method = "POST";

        $payload = array(
            "page" => $page,
            "size" => $size,
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
        $VIEW = "view/Shipper/HealthHistoryAJAX.phtml";
        require($VIEW);
    }
    public function AddHealthHistory()
    {
        LoginController::authentication();

        $data = "";
        $VIEW = "view/Shipper/AddHealthHistory.phtml";
        require("./template/main.phtml");
    }
    public function PostHealthHistory()
    {
        LoginController::authentication();
        $date = $_POST["date"];
        $positive_date = $_POST["positive_date"];
        $health_status = $_POST["health_status"];
        $temperature = $_POST["temperature"];
        $symptom = $_POST["symptom"];

        $API = new API();
        $url = "http://localhost:3000/api/shippers/update-health";
        $method = "POST";

        $payload = array(
            "date" => $date,
            "positive_date" => $positive_date,
            "health_status" => $health_status,
            "temperature" => $temperature,
            "symptom" => $symptom,
        );

        $result = $API->CallAPI($method, $url, $payload);
        $data = $result->message;

        if ($result->message == "Success") {
            header("Location:index.php?action=health-history");
        }
        $role = $_SESSION["role"];

        $VIEW = "view/Shipper/AddHealthHistory.phtml";
        require("./template/main.phtml");
    }
    public function UpdateOrderStatus()
    {
        LoginController::authentication();
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

    public function GetNewOrderByShipper()
    {
        LoginController::authentication();


        $API = new API();
        $url = "http://localhost:3000/api/orders/getNewOrderByShipper";
        $method = "GET";

        $result = $API->CallAPI($method, $url, null);


        echo json_encode($result);
    }
}
