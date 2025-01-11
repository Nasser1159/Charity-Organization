<?php

require_once "../Model/CartCommand.php";

class RemoveAllCommand implements CartCommand {
    private $cart;
    private $previousCart;

    public function __construct(&$cart) {
        $this->cart = &$cart;
    }

    public function execute() {
        $this->previousCart = $this->cart;
        $this->cart = [];
    }

    public function undo() {
        $this->cart = $this->previousCart;
    }
}
