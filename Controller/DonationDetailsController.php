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
        $_SESSION['cart'] = array();
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

$controller = new DonationDetailsController();

$command = isset($_GET['cmd']) ? $_GET['cmd'] : null;

$donationkey = isset($_GET['id']) ? $_GET['id'] : null;

if ($command !== null) {
    if ($command == 'viewDetails' && $donationkey !== null) {
        $controller->viewController($donationkey);
    }
    if ($command == 'add' && $donationkey !== null) {
        $controller->addController($donationkey);
    }
}