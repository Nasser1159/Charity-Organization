<?php

require_once "../Model/CartCommand.php";

class RemoveItemCommand implements CartCommand {
    private $item;
    private $cart;
    private $previousQuantity;

    public function __construct(&$cart, $item) {
        $this->cart = &$cart;
        $this->item = $item;
    }

    public function execute() {
        $this->previousQuantity = $this->cart[$this->item] ?? null;
        unset($this->cart[$this->item]);
        error_log("Removed item: {$this->item}, saved quantity: {$this->previousQuantity}");
    }

    public function undo() {
        if ($this->previousQuantity !== null) {
            $this->cart[$this->item] = $this->previousQuantity;
            error_log("Restored item: {$this->item}, restored quantity: {$this->previousQuantity}");
        }
        error_log("previous quantity equals null");

    }
}
