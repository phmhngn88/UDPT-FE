<?php
session_start();

require_once("./controller/Login.php");
require_once("./controller/Register.php");
require_once("./controller/Home.php");
require_once("./controller/Admin.php");
require_once("config/dbconnect.php");
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

    case "viewShipper":
        $controller = new AdminController();
        $controller->viewShipper();
        break;

    case "listShipper":
        $controller = new AdminController();
        $controller->listShipper();
        break;

    case "admin":
        $controller = new AdminController();
        $controller->index();
        break;

    case "viewStore":
        $controller = new AdminController();
        $controller->viewStore();
        break;
        
    case "listStore":
        $controller = new AdminController();
        $controller->listStore();
        break;

    case "viewCustomer":
        $controller = new AdminController();
        $controller->viewCustomer();
        break;
        
    case "listCustomer":
        $controller = new AdminController();
        $controller->listCustomer();
        break;

    case "listReview":
        $controller = new AdminController();
        $controller->listReview();
        break;

    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
