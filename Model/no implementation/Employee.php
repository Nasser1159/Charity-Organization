<?php
require_once "User.php";
require_once "../IVerifiable.php";
require_once "Roles.php";
class Employee extends User implements IVerifiable{
    private $role;
    private $salary;

    
    public function __construct(string $us,string  $p,string $e,string $bd,string $g,Roles $role,float $s) {
        $this->username = $us;
        $this->password = $p;
        $this->email = $e;
        $this->birthdate = $bd;
        $this->gender = $g;
        $this->role = $role;
        $this->salary = $s;
    }
    
    public function getSalary(): float {
        return $this->salary;
    }

    public function setSalary(float $s): void {
        $this->salary = $s;
    }

    public function getRole(): Roles {
        return $this->role;
    }

    

    public function submitResignationForm(): void {
        
    }

    public function requestTimeOff(): bool {
        
    }

    public function reportViolation(): void {
        
    }

    public function viewInsuranceCoverage(): void {
        
    }

    public function enrollInInsurance(): void {
        
    }

    public function login($Username, $Password) {
        
    }
}


