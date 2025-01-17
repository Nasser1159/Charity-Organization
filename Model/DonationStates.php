<?php
class DonatedState implements UserDonationState {
    public function displayDonationStatus(User $user) {
        echo "User " . $user->getUsername() . " has donated before and is verified.\n";
    }
}

class NotDonatedYetState implements UserDonationState {
    public function displayDonationStatus(User $user) {
        echo "User " . $user->getUsername() . " has not donated yet and is not verified.\n";
    }
}
?>