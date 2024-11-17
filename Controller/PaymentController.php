<?php

require_once "../Model/VisaPay.php";
require_once "../Model/FawryPay.php";
require_once "../Model/Payment.php";
require_once "../View/PaymentView.php";
require_once "../Model/DP_Donation.php";
require_once "../Model/DecOther.php";
require_once "../Model/DecTrans.php";
class PaymentController {

    public $payview;


    function __construct() {
        $this->payview= new PaymentView();
    }

    public function PaymentOptions($cost){
        
        $costDonation = new DP_Donation($_POST['cost']);


        if(isset($_POST['tr_add'])){
          $costDonation = new DecTrans($costDonation);
        }
        
       if (isset($_POST['other_add'])){
         $costDonation = new DecOther($costDonation);
       }

        $cost = $costDonation->get_TotalCost();
        $this->payview->ShowPaymentOptions($cost);
    }
  
    public function processPayment() {

    

        if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['paymentmethod']) && isset($_POST['cost'])) {

            $paymentMethod = $_POST['paymentmethod'];
            $amount = $_POST['cost'];
           

        }
        
        switch($paymentMethod) {
            case 'Fawry':
                $payment = new Payment();
                $payment->setPayMethod(new FawryPay());
                $result =$payment->makepayment($amount);
            
                if($result ){
                 $this->payview->PaymentResult($result, $paymentMethod,$amount);
                
                }
               break;
            case 'Visa':
                $payment = new Payment();
                $payment->setPayMethod(new VisaPay());
                $result =$payment->makepayment($amount);
                
                if($result){
                    $this->payview->PaymentResult($result, $paymentMethod,$amount);
                    }

                
                break;
       }
    
    }
}

$controller = new PaymentController();

$cmd = $_GET['cmd'];
$cost = $_POST['cost'];

if($cmd == 'paymentoptions'){

$controller->PaymentOptions($cost);
}

if ($cmd== 'result'){
$controller->processPayment();
}

?>


