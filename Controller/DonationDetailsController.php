<?php
require_once "../Model/DonationDetailsModel.php";
require_once "../Model/DonationModel.php";
require_once "../Model/ItemModel.php";
require_once "../View/DonationDetailsView.php";

class DonationDetailsController {
    function addController($donationkey) {
        session_start();
        foreach ($_SESSION['cart'] as $item => $quantity) {
            $itemModel = new ItemModel();
            $itemModel->getById($item);
            $x = new DonationDetailsModel($donationkey,$item,$quantity,$itemModel->getCost());
            $x->add();
        }
        $_SESSION['cart'] = array(); //to empty the cart after the donation
        $donationDetailsView = new DonationDetailsView();
        $donationmodel = new DonationModel();
        $donationmodel->getById($donationkey);
        $total = $donationmodel->getTotalCost();
        $donationDetailsView->ShowReciept($donationkey,DonationDetailsModel::view_all_id($donationkey),$total);
    }

    function viewController($donationkey) {
        $donationDetailsView = new DonationDetailsView();
        $stmt = DonationDetailsModel::view_all_id($donationkey);
        $donationDetailsView->ShowDonationDetailsTable($stmt);    
    }
}

/* $controller = new DonationDetailsController();
$command = $_GET['cmd'];
$donationkey = $_GET['id'];


if ($command == 'viewDetails') {
    $controller->viewController($donationkey, );
}
if($command == 'add'){
    $controller->addController($donationkey);
} */

$controller = new DonationDetailsController();

// Check if 'cmd' key exists in $_GET
$command = isset($_GET['cmd']) ? $_GET['cmd'] : null;

// Check if 'id' key exists in $_GET
$donationkey = isset($_GET['id']) ? $_GET['id'] : null;

if ($command !== null) {
    if ($command == 'viewDetails' && $donationkey !== null) {
        $controller->viewController($donationkey);
    }
    if ($command == 'add' && $donationkey !== null) {
        $controller->addController($donationkey);
    }
} else {
    echo "Invalid command or missing parameters.";
}
