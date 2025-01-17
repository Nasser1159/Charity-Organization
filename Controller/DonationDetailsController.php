<?php
require_once "../Model/DonationAdapter.php";
require_once "../View/DonationDetailsView.php";

class DonationDetailsController {
    private $donationAdapter;

    public function __construct() {
        $this->donationAdapter = new DonationAdapter();
    }

    public function addController($donationkey) {
        session_start();

        $details = [];
        foreach ($_SESSION['cart'] as $item => $quantity) {
            $itemModel = new ItemModel();
            $itemModel->getById($item);
            $details[] = [
                'item_id' => $item,
                'Qty' => $quantity,
                'price' => $itemModel->getCost()
            ];
        }

        $_SESSION['cart'] = [];

        $this->donationAdapter->addDonationDetails($donationkey, $details);

        $donationDetails = $this->donationAdapter->getDonationDetails($donationkey);
        $total = $this->donationAdapter->getTotalDonationCost($donationkey);

        $donationDetailsView = new DonationDetailsView();
        $donationDetailsView->ShowReciept($donationkey, $donationDetails, $total);
    }

    public function viewController($donationkey) {
        $donationDetails = $this->donationAdapter->getDonationDetails($donationkey);

        $donationDetailsView = new DonationDetailsView();
        $donationDetailsView->ShowDonationDetailsTable($donationDetails);
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
} else {
    echo "Invalid command or missing parameters.";
}
