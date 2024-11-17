<?php
require_once "pdo.php";
require_once "ModifiableAbstModel.php";
require_once "IVerifiable.php";

class DonorModel extends ModifiableAbstModel implements IVerifiable {
    
    const table = "donor";
    private $username;
    private $birthdate;
    private $email;
    private $password;
    private $phone_number;
    private $gender;

    public function __construct($username = "", $birthdate = "", $email = "", $password = "", $phone_number = "", $gender = 0) {
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->password = $password;
        $this->phone_number = $phone_number;
        $this->gender = $gender;
    }

    public function add() {

        $sql = "INSERT INTO ".self::table." (username, birthdate, email, password, phone_number, gender) 
        VALUES (:username, :birthdate, :email, :password, :phonenumber, :gender)";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(array(':username' => $this->username,
        ':birthdate' => $this->birthdate,
        ':email' => $this->email,
        ':password' => $this->password,
        ':phonenumber' => $this->phone_number,
        ':gender' => $this->gender));
        
        $lastInsertedId = Singleton::getpdo()->lastInsertId();

        $md5Hash = md5($lastInsertedId);
        
        $sql = "UPDATE ".self::table." SET donorid = :md5Hash WHERE id = :lastInsertedId";
        $stmt = Singleton::getpdo()->prepare($sql);
       return  $stmt->execute(array(
            ':md5Hash' => $md5Hash,
            ':lastInsertedId' => $lastInsertedId
        ));
    }

    public function read() {

        $sql = "SELECT * FROM ".self::table." WHERE donorid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->username = $row['username'];
        $this->birthdate = $row['birthdate'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->phone_number = $row['phone_number'];
        $this->gender = $row['gender'];
        return 1;
    
    }

    public function edit() {

        $sql = "UPDATE ".self::table." SET birthdate = :birthdate,
        email = :email, phone_number = :phonenumber,
        gender = :gender WHERE donorid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $this->id,
        'birthdate' => $this->birthdate,
        'email' => $this->email,
        'phonenumber' => $this->phone_number,
        'gender' => $this->gender]);
    }    

   public static function remove($id) {

        $sql = "DELETE FROM ".self::table." WHERE id = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function view_all(){

        $stmt = Singleton::getpdo()->query("SELECT * FROM ".self::table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exists($email){
        $sql = "SELECT COUNT(id) AS num_rows FROM ".self::table." WHERE email = :email";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result['num_rows'] > 0) {
            return true; // Email exists
        } else {
            return false; // Email does not exist
        }
    }
    static function login($Username, $Password){

        try {
            $stmt = Singleton::getpdo()->prepare('SELECT * FROM donor WHERE username = :username;');
            $stmt->execute(['username' => $Username]);
            
            $donor = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($donor) {
                $pass = ($donor['password']);
                if ($pass === $Password) {
                    $_SESSION['user_id'] = $donor['id'];
                    $_SESSION['username'] = $donor['username'];
                    return 1;
                } 
                else
                    $_SESSION['error'] = 'Invalid password.';
            } 
            else
                $_SESSION['error'] = 'User not found.';
        } 
        catch (PDOException $e) {
            $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        }
        return 0;
    }
    

    
    public function getUserName(){
        return $this->username;
    }

    /**
     * Get the value of birthdate
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of phone_number
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }
    public static function getByHash($hash) {
        $sql = "SELECT id FROM ".self::table." WHERE donorid = :id";
        $stmt = Singleton::getpdo()->prepare($sql);
        $stmt->execute(['id' => $hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }
}
