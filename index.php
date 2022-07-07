<?php
session_start();

require_once("./controller/Login.php");
require_once("./controller/Register.php");
require_once ("./controller/Shop.php");
require_once("./controller/Home.php");
require_once("config/dbconnect.php");
require_once("./controller/Product.php");
require_once("./controller/Customer.php");

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
    case "updateShop":
        $controller = new ShopController();
        $controller->updateShop();
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
    case "search-product":
        $controller = new ProductController();
        $controller->SearchProduct();
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
