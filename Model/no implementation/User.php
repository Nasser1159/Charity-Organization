<?php

abstract class User {
    private $userID;
    private $username;
    private $userType;
    private $birthdate;
    private $email;
    private $password;
    private $phoneNumber;
    private $gender;
    
    
    public function __construct($userID, $username, $userType, $birthdate, $email, $password, $phoneNumber, $gender) {
        $this->userID = $userID;
        $this->username = $username;
        $this->userType = $userType;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->gender = $gender;
    }
    
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getUserType() {
        return $this->userType;
    }
    
    public function setUserType($userType) {
        $this->userType = $userType;
    }
    
    public function getBirthdate() {
        return $this->birthdate;
    }
    
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
    
    public function getGender() {
        return $this->gender;
    }
    
    public function setGender($gender) {
        $this->gender = $gender;
    }
}

