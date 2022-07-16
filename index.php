<?php
session_start();

require_once("./controller/Login.php");
require_once("./controller/Register.php");
require_once ("./controller/Shop.php");
require_once ("./controller/Shipper.php");
require_once("./controller/Home.php");
require_once("./controller/Admin.php");
require_once("config/dbconnect.php");
require_once("./controller/Product.php");
require_once("./controller/Customer.php");
require_once("./controller/CustomerBackup.php");

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
    case "addProduct":
        $controller = new ShopController();
        $controller->addProduct();
        break;
    case "updateProduct":
        $controller = new ShopController();
        $controller->updateProduct();
        break;
    case "AllProductByShop":
        $controller = new ShopController();
        $controller->AllProductByShop();
        break;
    case "listProduct":
        $controller = new ShopController();
        $controller->listProduct();
        break;
    case "cusViewProductOfShop":
        $controller = new CustomerBackupController();
        $controller->viewListProduct();
        break;
    case "cusGetProductOfShopAJAX":
        $controller = new CustomerBackupController();
        $controller->listProduct();
        break;
    case "shop-update-order-status":
        $controller = new ShopController();
        $controller->UpdateOrderStatus();
        break;
    case "get-new-order-by-shop":
        $controller = new ShopController();
        // $controller->ViewShippingHistory();
        break;
    case "AllOrdertByShop":
        $controller = new ShopController();
        // $controller->AllOrdertByShop();
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
    case "cusViewStore":
        $controller = new CustomerBackupController();
        $controller->viewStore();
        break;
        
    case "cusListStore":
        $controller = new CustomerBackupController();
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

    case "viewReview":
        $controller = new AdminController();
        $controller->viewReview();
        break;

    case "listReview":
        $controller = new AdminController();
        $controller->listReview();
        break;
        
    case "replyComment":
        $controller = new AdminController();
        $controller->replyComment();
        break;

    case "updateShopStatus":
        $controller = new AdminController();
        $controller->updateShopStatus();
        break;

    case "customer":
        $controller = new CustomerController();
        $controller->updateCustomerInfo();
        break;
    case "customer-products":
        $controller = new CustomerController();
        $controller->searchProduct();
        break;
    case "addToCart":
        $controller = new CustomerController();
        $controller->addToCart();
        break;
    case "cart":
        $controller = new CustomerController();
        $controller->cart();
        break;
    case "cusCart":
        $controller = new CustomerBackupController();
        $controller->cart();
        break;
    case "addProductToCart":
        $controller = new CustomerBackupController();
        $controller->addProductToCart();
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
