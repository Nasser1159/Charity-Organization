<?php
require_once "FawryPay.php";
require_once "VisaPay.php";

class PaymentFactory {
    public static function createPaymentMethod($type): Ipay {
        switch ($type) {
            case 'Fawry':
                return new FawryPay();
            case 'Visa':
                return new VisaPay();
        }
    }
}
