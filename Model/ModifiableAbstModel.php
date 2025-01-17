<?php
require_once "ImodifiableModel.php";

abstract class ModifiableAbstModel implements ImodifiableModel
{
    protected $id = 0;

    public function add() {
        $this->insertData();
        list($lastInsertedId, $md5Hash) =  $this->getHash();
        $isUpdated = $this->updateHash($lastInsertedId, $md5Hash);
        return $isUpdated;
    }

    abstract protected function insertData();

    public function getHash(){
        $lastInsertedId = Singleton::getpdo()->lastInsertId();
        $md5Hash = md5($lastInsertedId);
        return [$lastInsertedId, $md5Hash];
    }

    abstract protected function updateHash($lastInsertedId, $md5Hash);
    
    
    public function getById($id) {
        $this->setId($id);
        $this->read();
    }

    // Get the value of id
    public function getId()
    {
        return $this->id;
    }

    //Set the value of id
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
