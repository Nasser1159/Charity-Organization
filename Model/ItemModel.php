<?php
require_once "pdo.php";
require_once "ModifiableAbstModel.php";
require_once "Iobserver.php";


class ItemModel extends ModifiableAbstModel implements IObserver{
    const table = "item";
    private $program_id;
    private $item_name;
    private $item_cost;
    private $amount; 
    private $program_name;
    private ISubject $ISubject;
    

    public function __construct($program_id = 0, $item_name = "", $item_cost = 0, $amount = 0, $program_name = "", $id = 0, ISubject $ISubject = new ProgramModel()) {
        $this->program_id = $program_id;
        $this->item_name = $item_name;
        $this->item_cost = $item_cost;
        $this->amount = $amount;
        $this->program_name = $program_name;
        $this->id = $id;
        $this->ISubject = $ISubject;
        if($ISubject){
            $this->ISubject->addObserver($this);
        }
    }

    public function add() {

        $sql = "INSERT INTO ".self::table." (program_id, item_name, item_cost, amount, program_name) 
        VALUES (:program_id, :item_name, :item_cost, :amount, :program_name)";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(array(':program_id' => $this->program_id,
        ':item_name' => $this->item_name,
        ':item_cost' => $this->item_cost,
        ':amount' => $this->amount,
        ':program_name' => $this->program_name,));

        $this->ISubject->addObserver($this);
        $lastInsertedId = Singleton::getpdo()->lastInsertId();

        $md5Hash = md5($lastInsertedId);
        
        $sql = "UPDATE ".self::table." SET itemid = :md5Hash WHERE id = :lastInsertedId";
        $stmt = Singleton::getpdo()->prepare($sql);
       return  $stmt->execute(array(
            ':md5Hash' => $md5Hash,
            ':lastInsertedId' => $lastInsertedId
        ));
    }
    public function read() {

        $sql = "SELECT * FROM " . self::table . " WHERE itemid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->program_id = $row['program_id'];
        $this->item_name = $row['item_name'];
        $this->item_cost = $row['item_cost'];
        $this->amount = $row['amount'];
        $this->program_name = $row['program_name'];
        
    }

    public function edit() {

        $sql = "UPDATE " . self::table . " SET program_id = :program_id, item_name = :Iname, item_cost = :cost,
        amount = :amount, program_name = :program_name  WHERE itemid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute([
            'id' => $this->id,
            'program_id' => $this->program_id,
            'Iname' => $this->item_name,
            'cost' => $this->item_cost,
            'amount' => $this->amount,
            'program_name' => $this->program_name
        ]);
    }

   public static function remove($id) {
        $sql = "DELETE FROM " . self::table . " WHERE itemid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } 

    public static function view_all(){

        $stmt = Singleton::getpdo()->query("SELECT * FROM " . self::table );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function view_all_id($id){

        $sql = "SELECT * FROM ".self::table." WHERE program_id = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemName(){
        return $this->item_name;
    }
    public function getProgramID(){
        return $this->program_id;
    }
    
    public function getCost(){
        return $this->item_cost;
    }
    
    public function getAmount(){
        return $this->amount;
    }

    public function getProgramName(){
        return $this->program_name;
    }
    
    public static function getByHash($hash) {
        $sql = "SELECT id FROM ".self::table." WHERE itemid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }

    public function update($program_name){
        $sql = "UPDATE " . self::table . " SET program_name = :program_name  WHERE itemid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute([
            'id' => $this->id,
            'program_name' => $program_name
        ]);
    }
}
?>
