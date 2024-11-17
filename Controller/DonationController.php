<?php
require_once "../Model/DonationModel.php";
require_once "../View/DonationView.php";
require_once "../Model/DP_Donation.php";
require_once "../Model/DecOther.php";
require_once "../Model/DecTrans.php";


class DonationController {
    function view_allController() {
        $donationView = new DonationsView();
        $stmt = DonationModel::view_all();
        $donationView->ShowDonationsTable($stmt);    
    }

    function addController() {
        session_start();
        $cost = $_POST['cost'];
        $donationModel = new DonationModel(md5($_SESSION['user_id']), $cost, date('y-m-d'));
        $donationModel->add(); 
    
         $donationid = $donationModel->getDonationId(md5($_SESSION['user_id']), $cost, date('y-m-d'));
        
        header("Location: DonationDetailsController.php?cmd=add&id=".$donationid); 
        return;    
    }
}

$dController = new DonationController();
$command = $_GET['cmd'];




if ($command == 'viewAll') {
    $dController->view_allController();
}
if ($command == 'add') {
    $dController->addController();
}
