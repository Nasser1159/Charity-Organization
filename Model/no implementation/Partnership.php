<?php
require_once "PartnershipType.php";
require_once "../imodifiableModel.php";
require_once "../pdo.php";
abstract class Partnership implements ImodifiableModel{
    private $partnershipID;
    private $name;
    private $location;
    private $phoneNumbers;
    private $type;
    private $performanceRate;
    private $frequency;

    
    public function __construct($n, $loc, $type, $freq) {
        $this->name = $n;
        $this->location = $loc;
        $this->type = $type;
        $this->frequency = $freq;
    }

    
    public function setFreq($f): void {
        $this->frequency = $f;
    }

    public function setRate(float $r): void {
        $this->performanceRate = $r;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getRate(): float {
        return $this->performanceRate;
    }

    public function getAvailabillity(): bool {
        
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFreq(): string {
        return $this->frequency;
    }

    public function getPhone(): array {
        return $this->phoneNumbers;
    }

    public function getLocation(): string {
        return $this->location;
    }
}
