<?php
require_once "Employee.php";
require_once "../ItemModel.php";
require_once "Order.php";

class WarehouseCoordinator extends Employee{
    
    public function placeOrder($supplierID, array $items): Order {
        
    }
}


