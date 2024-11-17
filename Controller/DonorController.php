<?php
require_once "../Model/DonorModel.php";
require_once "../View/DonorView.php";

class DonorController {
  public $donorView;
  function __construct() {
    $this->donorView = new DonorView();
  }
  function signup() {
    $error = isset($_SESSION['signup_error']) ? $_SESSION['signup_error'] : null;
    $this->donorView->signup($error);
    unset($_SESSION['signup_error']); 
   
  }
  function myaccount($id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
      session_start();
      $donorModel = new DonorModel($_SESSION['user_id'], $_POST['birthdate'],
        $_POST['email'], "", $_POST['phone'], $_POST['gender']);
      $donorModel->setId(md5($_SESSION['user_id']));
      $donorModel->edit();
      header("Location: HomeController.php");
      exit();
    }
    else{
      $donor = new DonorModel();
      $donor->getById($id);
      $this->donorView->ShowDonorDetails($donor);
    }
  }
  function viewAll() {
    $stmt = DonorModel::view_all();
    $this->donorView->ShowDonorsTable($stmt);
  }
  function view_donations() {
    require_once "../Model/DonationDetailsModel.php";

    $donorId = md5($_SESSION['user_id']); 
    $donorModel = new DonorModel();
    $donorModel->getById($donorId);

      
    $stmt = DonationDetailsModel::view_all_donor($donorId);
    $this->donorView->ShowMyDD($stmt, $donorModel);  
  }
  function signupValid() {
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password'])); 
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $birthdate = trim($_POST['birthdate']);
    $gender = trim($_POST['gender']);

   $donormodel =new DonorModel();
   //$donorview = new DonorView();
    if($donormodel->exists($email)){

      $_SESSION['signup_error'] = 'Email already exists';
      header("Location: ../Controller/DonorController.php?cmd=signup");
      exit();
    }
    else{
      $donor = new DonorModel($username,$birthdate,$email, $password,  $phone, $gender);  
      $donor->add();
    
      header("Location: ../Controller/HomeController.php?cmd=login");}
  }
}

$command = $_GET['cmd'];

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
else $id = 0;

$controller = new DonorController();
session_start();

if ($command == 'signup') {
  $controller->signup();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $command =='signup') {
  $controller->signupValid();
}
if ($command == 'myacc' && $id !== null)
{
  $controller->myaccount($id);
}


if ($command == 'viewdonations') {
  $controller->view_donations();
}

if ($command == 'viewAll') {
  $controller->viewAll();
}
