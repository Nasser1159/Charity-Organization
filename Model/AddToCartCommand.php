<?php

require_once "../Model/CartCommand.php";

class AddToCartCommand implements CartCommand {
    private $item;
    private $quantity;
    private $cart;
    private $previousQuantity;

    public function __construct(&$cart, $item, $quantity) {
        $this->cart = &$cart;
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function execute() {
        $this->previousQuantity = $this->cart[$this->item] ?? null;
        $this->cart[$this->item] = $this->quantity;
    }

    public function undo() {
        if ($this->previousQuantity === null) {
            unset($this->cart[$this->item]);
        } else {
            $this->cart[$this->item] = $this->previousQuantity;
        }
    }
}
