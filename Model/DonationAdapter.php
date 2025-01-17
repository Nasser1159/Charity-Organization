<?php
require_once "IDonationAdapter.php";
require_once "DonationModel.php";
require_once "DonationDetailsModel.php";

class DonationAdapter implements DonationAdapterInterface {
    private $donationModel;
    private $detailsModel;

    public function __construct() {
        $this->donationModel = new DonationModel();
        $this->detailsModel = new DonationDetailsModel();
    }

    public function addDonation($donor_id, $total_cost, $donation_date, $details) {
        $this->donationModel->setDonorId($donor_id);
        $this->donationModel->setTotalCost($total_cost);
        $this->donationModel->setDate($donation_date);
        $this->donationModel->add();

        $donation_id = DonationModel::getDonationId($donor_id, $total_cost, $donation_date);

        foreach ($details as $detail) {
            $this->detailsModel = new DonationDetailsModel(
                $donation_id,
                $detail['item_id'],
                $detail['Qty'],
                $detail['price']
            );
            $this->detailsModel->add();
        }
    }

    public function getDonationDetails($donation_id) {
        $details = DonationDetailsModel::view_all_id($donation_id);
        $formattedDetails = [];
    
        foreach ($details as $detail) {
            $formattedDetails[] = [
                'item_id' => $detail['item_id'],
                'quantity' => $detail['Qty'],
                'price' => $detail['price'],
                'total' => $detail['Qty'] * $detail['price'],
            ];
        }
    
        return $formattedDetails;
    }

    public function addDonationDetails($donation_id, $details) {
        foreach ($details as $detail) {
            $this->detailsModel = new DonationDetailsModel(
                $donation_id,
                $detail['item_id'],
                $detail['Qty'],
                $detail['price']
            );
            $this->detailsModel->add();
        }
    }

    public function getTotalDonationCost($donation_id) {
        $this->donationModel->getById($donation_id);
        return $this->donationModel->getTotalCost();
    }

    public function view_all() {
        return DonationModel::view_all();
    }
}



?>