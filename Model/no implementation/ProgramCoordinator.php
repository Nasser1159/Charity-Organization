<?php
require_once "Employee.php";
require_once "../ProgramModel.php";
require_once "../DonorModel.php";
require_once "VolunteerRequest.php";
class ProgramCoordinator extends Employee{
    
    public function updateRequestStatus(DonorModel $d, RequestStatus $newStatus): bool {
        
    }

    public function addProgram(ProgramModel $program): void {
        
    }

    public function removeProgram($programID): void {
        
    }

    public function editProgram(): void {
        
    }
}

?>
