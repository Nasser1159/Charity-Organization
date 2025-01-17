DonationFacade

<?php
require_once "DonationAdapter.php";
require_once "DonationModel.php";
require_once "DonationDetailsModel.php";

class DonationFacade {
    private $donationAdapter;
    private $donationModel;
    private $detailsModel;

    public function __construct() {
        $this->donationAdapter = new DonationAdapter();
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

        return $donation_id;
    }

    public function getTotalDonationCost($donation_id) {
        return $this->donationAdapter->getTotalDonationCost($donation_id);
    }

    public function getDonationDetails($donation_id) {
        $details = DonationDetailsModel::view_all_id($donation_id);
        $formattedDetails = [];
    
        foreach ($details as $detail) {
            $formattedDetails[] = [
                'id' => $detail['id'] ?? 'N/A',
                'item_id' => $detail['item_id'] ?? 'N/A',
                'Qty' => $detail['Qty'] ?? 0,
                'price' => $detail['price'] ?? 0,
            ];
        }
    
        return $formattedDetails;
    }

    public function getAllDonations() {
        return $this->donationAdapter->view_all();
    }
}
?>