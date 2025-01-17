<?php
class User {
    private $userId;
    private $username;
    private $donationState;

    public function __construct($userId, $username, UserDonationState $initialState) {
        $this->userId = $userId;
        $this->username = $username;
        $this->donationState = $initialState;
    }

    public function setDonationState(UserDonationState $state) {
        $this->donationState = $state;
    }

    public function displayDonationStatus() {
        $this->donationState->displayDonationStatus($this);
    }

    public function getUsername() {
        return $this->username;
    }

    public function getUserId() {
        return $this->userId;
    }
}
?>