<?php
require_once "ImodifiableModel.php";

abstract class ModifiableAbstModel implements ImodifiableModel
{
    protected $id = 0;
    
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
