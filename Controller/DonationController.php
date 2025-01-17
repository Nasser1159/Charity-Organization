<?php
require_once "../Model/DonationFacade.php";
require_once "../View/DonationView.php";

class DonationController {
    private $donationFacade;

    public function __construct() {
        $this->donationFacade = new DonationFacade();
    }

    public function view_allController() {
        $donationIterator = $this->donationFacade->getAllDonations();

        $donationView = new DonationsView();
        $donationView->ShowDonationsTable($donationIterator);
    }

    public function addController() {
        session_start();
        $cost = $_POST['cost'];
        $details = $_POST['details'];

        $donation_id = $this->donationFacade->addDonation(
            md5($_SESSION['user_id']),
            $cost,
            date('y-m-d'),
            $details
        );

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


?>