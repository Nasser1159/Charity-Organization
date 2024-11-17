<?php
require_once "../itemModel.php";
require_once "OrderStatus.php";
Class Order{
    private $orderIdD;
    private $status;
    private $requesterlD;
    private $orderltems = array();

    public function setStatus (Orderstatus $orderstatus) : void{

    }

    public function getStatus() : OrderStatus{
        return $this->status;
    }

    public function getOrderID() : int{
        return $this->orderIdD;
    }

    public function addltem(ItemModel $Item) : void{

    }

    public function removeltem(ItemModel $item) : void{

    }

    public function calcTotalnoOfltems() : int{

    }

    public function updateltemQuantity($itemID, int $quantity ) : void{

    }

    public function calcTotalQuantity() : int{

    }
}    
