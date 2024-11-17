<?php
require_once "RequestStatus.php";
class VolunteerRequest {
    private $requestID;
    private $status;

    
    public function __construct(RequestStatus $reqst) {
        $this->reqst = $reqst;
    }

    
    public function sendVolunteerEmail(): bool {
        
    }
}
