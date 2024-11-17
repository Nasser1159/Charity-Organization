<?php
    require_once("Ipay.php");
    class Payment{
        private $paymentmethod;
        public function getPayMethod() {
            return $this->paymentmethod;
        }
        public function setPayMethod($paymentmethod) {
            $this->paymentmethod = $paymentmethod;
            return $this;
        }
        public function makepayment($amount){
            return $this->paymentmethod->pay($amount);
        }
}

?>