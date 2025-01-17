<?php

interface DonationAdapterInterface {
    public function addDonation($donor_id, $total_cost, $donation_date, $details);
    public function getDonationDetails($donation_id);
}
?>