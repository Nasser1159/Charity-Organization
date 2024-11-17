<?php
require_once "pdo.php";
require_once "ModifiableAbstModel.php";

class SupplierModel extends ModifiableAbstModel {
    
    private $name;
    private $address; 
    const table = "supplier";

    public function __construct($name = "", $address = "") {
        $this->name = $name;
        $this->address = $address;
    }

    public function add() {
        
        $sql = "INSERT INTO ".self::table." (name, address) 
                VALUES (:name, :address)";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(array(
            ':name' => $this->name,
            ':address' => $this->address
        ));
        
        $lastInsertedId = Singleton::getpdo()->lastInsertId();

        $md5Hash = md5($lastInsertedId);
        
        $sql = "UPDATE ".self::table." SET supplierid = :md5Hash WHERE id = :lastInsertedId";
        $stmt = Singleton::getpdo()->prepare($sql);
       return  $stmt->execute(array(
            ':md5Hash' => $md5Hash,
            ':lastInsertedId' => $lastInsertedId
        ));
    }
    

    public function read() {
        $sql = "SELECT * FROM ".self::table." WHERE supplierid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->address = $row['address'];
        $this->name = $row['name'];
        return 1;
    }

    public function edit() {

        $sql = "UPDATE ".self::table." SET name = :name, address = :address  WHERE supplierid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute([
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address
        ]);
    }

   public static function remove($id) {  

        $sql = "DELETE FROM ".self::table." WHERE supplierid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } 

    public static function view_all(){

        $stmt = Singleton::getpdo()->query("SELECT * FROM ". self::table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }
}
