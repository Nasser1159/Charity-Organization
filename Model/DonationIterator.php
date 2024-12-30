<?php
require_once "IDonationIterator.php";
require_once "DonationModel.php";

class DonationIterator implements IDonationIterator {
    private $donations;
    private $currentIndex = 0;

    public function __construct(array $donations) {
        $this->donations = $donations;
    }

    public function hasNext(): bool {
        return $this->currentIndex < count($this->donations);
    }

    public function next(): array {
        return $this->donations[$this->currentIndex++];
    }
}
