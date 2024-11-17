<?php
require_once "DP_IDonation.php";
class DP_Donation implements DP_IDonation {

    private $cost;

    function __construct($cost) {
        $this->cost = $cost;
    }
    function get_TotalCost() {
        return $this->cost;
    }
}