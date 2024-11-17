<?php

class Recipient {
    private $name;
    private $location;
    private $contactInfo;
    private $orderRequested;

   
    public function __construct($name, $location, $contactInfo, $orderRequested) {
        $this->name = $name;
        $this->location = $location;
        $this->contactInfo = $contactInfo;
        $this->orderRequested = $orderRequested;
    }

    
    public function requestFood(): bool {
        
    }
}
