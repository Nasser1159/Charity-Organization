<?php
require_once "pdo.php";
require_once "ModifiableAbstModel.php";
require_once "Isubject.php";
require_once "Iobserver.php";
require_once "ItemModel.php";

class ProgramModel extends ModifiableAbstModel implements ISubject{
    const table = "program";
    public $observers = [];
    private $program_name;
    private $description;

    public function __construct($program_name = "", $description = "", $id = 0) {
        $this->program_name = $program_name;
        $this->description = $description;
        $this->id = $id;
            $sql = "SELECT * FROM item WHERE program_id = :id";
            $stmt = Singleton::getpdo()->prepare($sql);
            $stmt->execute(['id' => $id]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row){
                $obs = new ItemModel($row['program_id'], $row['item_name'], $row['item_cost'], $row['amount'], $row['program_name'], $row['itemid'], $this);
                $this->addObserver($obs);
            }
        
    }

    public function add() {

        $sql = "INSERT INTO ".self::table." (program_name, description) 
        VALUES (:program, :description)";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(array(':program' => $this->program_name,
        ':description' => $this->description));
        
        $lastInsertedId = Singleton::getpdo()->lastInsertId();

        $this->id = md5($lastInsertedId);
        $md5Hash = md5($lastInsertedId);
        
        $sql = "UPDATE ".self::table." SET programid = :md5Hash WHERE id = :lastInsertedId";
        $stmt = Singleton::getpdo()->prepare($sql);
       return  $stmt->execute(array(
            ':md5Hash' => $md5Hash,
            ':lastInsertedId' => $lastInsertedId
        ));
    }

    public function read() {
        $sql = "SELECT * FROM " . self::table . " WHERE programid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->program_name = $row['program_name'];
        $this->description = $row['description'];
        return 1;
    }

    public function edit() {

        $sql = "UPDATE " . self::table . " SET 
        program_name = :program, description = :description WHERE programid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id,
        'program' => $this->program_name,
        'description' => $this->description]); 
        $this->notifyObservers();
        return $stmt;

    }

   public static function remove($id) {

        $sql = "DELETE FROM " . self::table . " WHERE programid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function view_all(){

        $stmt = Singleton::getpdo()->query("SELECT * FROM " . self::table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProgramName(){
        return $this->program_name;
    }
    public function getProgramDescription(){
        return $this->description;
    }
    public static function getByHash($hash) {
        $sql = "SELECT id FROM ".self::table." WHERE programid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }

    public function addObserver(IObserver $Iobserver){
        $this->observers[] = $Iobserver;
    }

    public function removeObserver(IObserver $Iobserver){
        $key = array_search($Iobserver, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notifyObservers(){
        foreach ($this->observers as $observer) {
            $observer->update($this->program_name);
        }
    }

    public function getnamefromid($id){
        $this->setId($id);
        $sql = "SELECT * FROM " . self::table . " WHERE programid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => md5($this->id)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->program_name = $row['program_name'];
        return 1;
    }
}

?>
