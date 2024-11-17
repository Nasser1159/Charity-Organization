<?php
require_once "pdo.php";
require_once "ModifiableAbstModel.php";
include_once "../Model/no implementation/Receipt.php";

class DonationModel extends ModifiableAbstModel {

    const table = "donations";
    private $donor_id;
    private $total_cost;
    private $donation_date;
    private $receipt;

    public function __construct($donor_id = "", $total_cost=0, $donation_date = "") {
        $this->donor_id = $donor_id;
        $this->total_cost = $total_cost;
        $this->donation_date = $donation_date;
    }

    

    public function add() {
        
        
        $sql = "INSERT INTO ".self::table." (donor_id, total_cost, donation_date)
                VALUES (:donor, :cost, :date)";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(array(
            'donor' => $this->donor_id,
            'cost' => $this->total_cost,
            'date' => $this->donation_date
        ));
       
        $lastInsertedId = Singleton::getpdo()->lastInsertId();

        $this->id = md5($lastInsertedId);
        $md5Hash = md5($lastInsertedId);
        
        $sql = "UPDATE ".self::table." SET donationid = :md5Hash WHERE id = :lastInsertedId";
        $stmt = Singleton::getpdo()->prepare($sql);
       return  $stmt->execute(array(
            ':md5Hash' => $md5Hash,
            ':lastInsertedId' => $lastInsertedId
        ));
    }

public static function getDonationId($donor_id, $total_cost, $donation_date) {
    
    
    $sql = "SELECT donationid FROM ".self::table." WHERE donor_id = :donor_id AND total_cost = :total_cost AND donation_date = :donation_date";
    $stmt = Singleton::getpdo()->prepare($sql);
    $stmt->execute([
        'donor_id' => $donor_id,
        'total_cost' => $total_cost,
        'donation_date' => $donation_date
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row['donationid'];
}
    

    public function read() {
        
        $sql = "SELECT * FROM ".self::table." WHERE donationid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->donor_id = $row['donor_id'];
        $this->total_cost = $row['total_cost'];
        $this->donation_date = $row['donation_date'];
        return 1;
    }

    public function edit() {
        $sql = "UPDATE ".self::table." SET donor_id = :donor, total_cost = :cost, donation_date = :date WHERE donationid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute([
            'id' => $this->id,
            'donor' => $this->donor_id,
            'cost' => $this->total_cost,
            'date' => $this->donation_date,
        ]);
    }

    public static function remove($id) {

        $sql = "DELETE FROM ".self::table." WHERE donationid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function view_all(){
        
        $stmt = Singleton::getpdo()->query("SELECT * FROM ".self::table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function view_all_donor($donor_id){
        
        $sql = "SELECT * FROM ".self::table." WHERE donor_id = :donor_id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['donor_id' => $donor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the value of donor_id
     */
    public function getDonorId()
    {
        return $this->donor_id;
    }

    /**
     * Set the value of donor_id
     */
    public function setDonorId($donor_id): self
    {
        $this->donor_id = $donor_id;

        return $this;
    }
    
    /**
     * Get the value of total_cost
     */
    public function getTotalCost()
    {
        return $this->total_cost;
    }

        /**
     * Get the value of donation_date
     */
    public function getDonationDate()
    {
        return $this->donation_date;
    }

    public function setTotalCost($cost){
        $this->total_cost = $cost;
    }
    public function setDate($date){
        $this->donation_date = $date;
    }
    public static function getLastInsertedId() {
         // Assuming Singleton::getpdo() is your database connection object
        return Singleton::getpdo()->lastInsertId();
    }

    //Not Implemented//
    public function setReceiptInfo(Receipt $r): void {
        $this->receipt = $r;
    }

    
    public function sendConfirmationEmail(): bool {
        
    }

    public function sendReceiptToDonor(Receipt $r): void {
        
    }

    public function displayReceipt(Receipt $r): void {
        
    }

    public function exportToFormat(Receipt $r): void {
        
    }

    public function getReceiptID(Receipt $r): string {
        return $r->receiptID;
    }

    public static function getByHash($hash) {
        $sql = "SELECT id FROM ".self::table." WHERE donationid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }
}
