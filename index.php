<?php
session_start();

require_once("./controller/Login.php");
require_once("./controller/Register.php");
require_once("./controller/Home.php");
require_once("./controller/Shipper.php");

$action = "";
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

switch ($action) {
    case "error":
        $controller = new LoginController();
        $controller->unauthorized_page();
        break;
    case "logout":
        $controller = new LoginController();
        $controller->logout();
        break;
    case "login":
        $controller = new LoginController();
        $controller->login();
        break;
    case "register":
        $controller = new RegisterController();
        $controller->register();
        break;
    case "shipping-history":
        $controller = new ShipperController();
        $controller->ViewShippingHistory();
        break;
    case "search-shipping-history":
        $controller = new ShipperController();
        $controller->SearchShippingHistory();
        break;
    case "shipping-order-detail":
        $controller = new ShipperController();
        $controller->ShippingOrderDetail();
        break;
    case "delivering":
        $controller = new ShipperController();
        $controller->DeliveringOrder();
        break;
    case "health-history":
        $controller = new ShipperController();
        $controller->HealthHistory();
        break;
    case "search-health-history":
        $controller = new ShipperController();
        $controller->GetHealthHistory();
        break;
    case "add-health-history":
        $controller = new ShipperController();
        $controller->AddHealthHistory();
        break;
    case "post-health-history":
        $controller = new ShipperController();
        $controller->PostHealthHistory();
        break;
    case "shipper-update-order-status":
        $controller = new ShipperController();
        $controller->UpdateOrderStatus();
        break;
    case "get-new-order-by-shipper":
        $controller = new ShipperController();
        $controller->GetNewOrderByShipper();
        break;

    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
