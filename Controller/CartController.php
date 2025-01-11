<?php
require_once "..\View\CartView.php";
require_once "..\Model\pdo.php";
require_once "../Model/CommandManager.php";
require_once "../Model/RemoveItemCommand.php";
require_once "../Model/RemoveAllCommand.php";
require_once "../Model/AddToCartCommand.php";

session_start();

class CartController {
    public $cartView;
    private $commandManager;
    private $cart;

    function __construct() {
        $this->cartView = new CartView();
        $this->commandManager = new CommandManager();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->cart = &$_SESSION['cart'];
    }

    public function showCartController() {
        $this->cartView->ShowCart();
    }

    public function addToCartController() {
        $command = new AddToCartCommand($this->cart, $_POST['item'], $_POST['quantity']);
        $this->commandManager->executeCommand($command);
        header("Location: ProgramController.php?cmd=showtouser&id=" . $_GET['id']);
    }

    public function removeItemController() {
        $item = $_GET['item'];
        $command = new RemoveItemCommand($this->cart, $item);
        $this->commandManager->executeCommand($command);
        $this->cartView->ShowCart();
    }

    public function removeAllController() {
        $command = new RemoveAllCommand($this->cart);
        $this->commandManager->executeCommand($command);
        header("Location: CartController.php?cmd=showcart");
    }

    public function undoLastAction() {
        $this->commandManager->undoCommand();
        $this->cartView->ShowCart();
    }
}

$controller = new CartController();
$command = $_GET['cmd'];

if ($command == 'showcart') {
    $controller->showCartController();
} elseif ($command == 'addToCart') {
    $controller->addToCartController();
} elseif ($command == 'removeitem') {
    $controller->removeItemController();
} elseif ($command == 'removeall') {
    $controller->removeAllController();
} elseif ($command == 'undo') {
    $controller->undoLastAction();
}

$controller->cartView->PrintFooter();
