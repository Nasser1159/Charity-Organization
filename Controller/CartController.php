<?php
require_once "..\View\CartView.php";
require_once "..\Model\pdo.php";
session_start();

class CartController{
    public $cartView;
    function __construct() {
        $this->cartView = new CartView();
    }

    public function showCartController(){
        $this->cartView->ShowCart();
    }

    public function addToCartController(){
        session_start();
        if(empty($_SESSION['cart']))
            $_SESSION['cart']=array();
        $_SESSION['cart'][$_POST['item']] = $_POST['quantity'];
        /*foreach ($_SESSION['cart'] as $item => $quantity) {
            echo "Item: $item, Quantity: $quantity <br>";
        }*/
        header("Location: ProgramController.php?cmd=showtouser&id=".$_GET['id']);
        return;
    }

    public function removeItemController(){
        $item = $_GET['item'];
        unset($_SESSION['cart'][$item]);
        $this->cartView->ShowCart();
    }

    public function removeAllController(){
        $_SESSION['cart'] = array();
        header("Location: CartController.php?cmd=showcart");
    }

}

$controller = new CartController();
$command = $_GET['cmd'];
$cartView = new CartView();  

if ($command == 'showcart') {
    $controller->showCartController();
}

else if ($command == 'addToCart' ) {
    $controller->addToCartController();
}

else if ($command == 'removeitem') {
    $controller->removeItemController();
}

else if ($command == 'removeall')
    $controller->removeAllController();

$controller->cartView->PrintFooter();
