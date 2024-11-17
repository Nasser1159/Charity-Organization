<?php
require_once "Recipient.php";
require_once "Donation.php";
require_once "Employee.php";
class ExecutiveDirector extends Employee{
    
    public function viewMonthlyDonations(int $year): float {
        
    }

    public function contactRecipient(Recipient $recipient): void {
        
    }
}
