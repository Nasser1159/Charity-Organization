<?php
require_once "../Model/DonationAdapter.php";
require_once "../View/DonationView.php";

class DonationController {
    public function view_allController() {
        $donationView = new DonationsView();
        $donationAdapter = new DonationAdapter();
        $iterator = $donationAdapter->view_all();
        $donationView->ShowDonationsTable($iterator);
    }

    public function addController() {
        session_start();
        $cost = $_POST['cost'];
        $details = $_POST['details'];
        
        $donationAdapter = new DonationAdapter();
        
        $donationAdapter->addDonation(md5($_SESSION['user_id']), $cost, date('y-m-d'), $details);
        
        $donation_id = DonationModel::getDonationId(md5($_SESSION['user_id']), $cost, date('y-m-d'));
        
        header("Location: DonationDetailsController.php?cmd=add&id=" . $donation_id);
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
