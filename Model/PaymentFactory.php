<?php
require_once "Ipay.php";
require_once "FawryPay.php";
require_once "VisaPay.php";

class PaymentFactory {
    public static function createPaymentMethod($paymentMethod) {
        switch ($paymentMethod) {
            case 'Fawry':
                return new FawryPay();
            case 'Visa':
                return new VisaPay();
        }
    }
}
