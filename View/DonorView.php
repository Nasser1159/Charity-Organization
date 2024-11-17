<?php
require_once "ViewAbst.php";
require_once "../Model/DonorModel.php";
require_once "../Model/DonationModel.php";
require_once "../Model/ProgramModel.php";
require_once "../Model/ItemModel.php";
require_once "../Model/GenderEnum.php";

class DonorView extends ViewAbst{
    function signup($error = null){
        echo('<!DOCTYPE html>
        <html>
        
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../CSS/signup.css">
                <title>Sign Up</title>
            </head>
        
            <body>
                <section class="container">
                    <header><h1>Registration Form</h1></header>
                    <form action="../Controller/DonorController.php?cmd=signup" method="post" class="form">
                        <div class = "input-box">
                            <label>Username:</label>
                            <input type="text" id="username" name="username" placeholder="Enter your username" required>
                        </div>
        
                        <div class = "input-box">
                            <label>Password:</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
        
                        <div class = "input-box">
                            <label>Email Address:</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                        </div>   
        
                        <div class="column">
                            <div class = "input-box">
                                <label>Phone Number:</label>
                                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div> 
        
                            <div class = "input-box">
                                <label>Birth Date:</label>
                                <input type="date" id="birthdate" name="birthdate" required>
                            </div> 
                        </div>
        
                        <div class="gender-box">
                            <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="male" name="gender" value="'.GenderEnum::Male->value.'" required/>
                                    <label for="check">Male</label>
                                </div> 
                                <div class="gender">
                                    <input type="radio" id="female" name="gender" value="'.GenderEnum::Female->value.'" required/>
                                    <label for="check">Female</label>
                                </div> 
                            </div>    
                        </div>
                        
                        <button>Submit</button>
                        <p class="login-link">Already have an account? <a href="../Controller/HomeController.php?cmd=login">Login</a></p>');
                        if($error !== null){
                           echo('<p style="color: red;">' . $error . '</p>');
                        }

                        echo ('
                    </form>
                </section>
            </body>
        </html>
        ');
    }
    function ShowDonorsTable($rows) {
        
        echo('<!DOCTYPE html>
        <html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../CSS/CRUD.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                <title>Donor CRUD</title>
        </head>
        <body>
        <header>
                <h1>Donor Database</h1>
                <nav>
                    <ul>
                        <li><a class="kk" href="../View/dashboard.php">Dashboard</a></li>
                        <li><a class="kk" href="../Controller/DonationController.php?cmd=viewAll">Back</a></li>
                    </ul>
                </nav>
        </header>
        <div class="container">
        
           <div class="object-display">
                <table class="object-display-table">
                    <thead>
                    <tr>
                        <th>Donor ID</th>
                        <th>User Name</th>
                        <th>Birthdate</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                    </tr>
                    </thead>
        ');

        foreach($rows as $row)
            echo('
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['birthdate'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>'.( ($row['gender'] == GenderEnum::Male->value)?"Male":"Female" ).'</td>
                </tr>
            ');
    }

    function ShowDonorDetails($donor) {
        echo( '<html lang="en"><head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="..\CSS\myacc.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                <title>Food Bank</title>
            </head>
            <body>
                <header>
                    <h1>Food Bank</h1>
                    <nav>
                        <ul>
                            <li><a class="kk" href="..\Controller\HomeController.php">Home</a></li>
                            <li><a href="..\Controller\CartController.php?cmd=showcart" class="kk">Cart</a></li>                           
                        </ul>
                    </nav>
                </header>
                
                <main>
                    <h2>My Account</h2>
                    <form action="../Controller/DonorController.php?cmd=myacc" method="post">
                    <label>Username: </label>
                    <input type="text" id="username" name="username" value="'.$donor->getUserName().'" readonly>
                    <br><br>
            
                    <label>Birthdate: </label>
                    <input type="date" id="birthdate" name="birthdate" value="'.$donor->getBirthdate().'">
                    <br><br>
            
                    <label>Email: </label>
                    <input type="email" id="email" name="email" value="'.$donor->getEmail().'">
                    <br><br>
            
                    <label>Phone Number: </label>
                    <input type="text" id="phone" name="phone" value="'.$donor->getPhoneNumber().'">
                    <br><br>
                    
                    <div class="gender-box">
                        <div class="gender-option">
                            <div class="gender">
                            
                                <label for="check" class="box">Male</label>
                                <input type="radio" id="male" name="gender" value="'.GenderEnum::Male->value.'" required ');
                                if ($donor->getGender() == GenderEnum::Male->value)
                                    echo(' checked');
                                echo('/></div> 
                                        <div class="gender">
                                            <br/><br/><label for="check" class="box">Female</label>
                                            <input type="radio" id="female" name="gender" value="'.GenderEnum::Female->value.'" required ');
                                if ($donor->getGender() == GenderEnum::Female->value)
                                    echo(' checked');
                                echo('/></div> 
                        </div>
                    </div>
                    <br><br>
            
                    <input type="submit" value="Update">
                    <br><br>
                </form>
                <p class="updatepass-link"><a href="..\Controller\DonorController.php?id='.md5( $_SESSION['user_id']).'&cmd=viewdonations">My Donations</a></p>
                <p class="logout-link"><a href="..\Controller\HomeController.php?cmd=logout">Logout</a></p>
                </main>
                <footer>
                    <p>© 2024 Food Bank</p>
                </footer>
            </body>
        </html>'
    );
    }
    function ShowMyDD($rows, $obj) {
        $programModel = new ProgramModel();
        $itemModel = new ItemModel();  
        echo('
        <!DOCTYPE html>
        <html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../CSS/CRUD.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                <title>Donation CRUD</title>
        </head>
        <body>
        <header>
                <h1>Donation Database</h1>
                <nav>
                    <ul>
                        <li><a class="kk" href="..\Controller\HomeController.php">Home</a></li>
                        <li><a class="kk" href="..\Controller\DonorController.php?id='.md5( $_SESSION['user_id']).'&cmd=myacc">My Account</a></li>
                        <li><a class="kk" href="..\Controller\HomeController.php?cmd=logout">Logout</a></li>
                        <li><a class="kk" href="..\Controller\CartController.php?cmd=showcart">Cart</a></li>
                    </ul>
                </nav>
        </header>
        <div class="container">
        
           <div class="object-display">
                <table class="object-display-table">
                    <thead>
                    <tr>
                        <th>Donation ID</th>
                        <th>Donor name</th>
                        <th>Item Name</th>
                        <th>Program Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
        ');

        foreach($rows as $row) {
            $itemModel->getById($row['item_id']);
            $programModel->getById($itemModel->getProgramID());
            echo('
            <tr>
                <td>'. DonationModel::getByHash($row['donation_id']).'</td>
                <td>'.$obj->getUserName().'</td>
                <td>'.$itemModel->getItemName().'</td>
                <td>'.$programModel->getProgramName().'</td>
                <td>'.$row['Qty'].'</td>
                <td>'.$row['price'].'EGP</td>
                <td>'.$row['Qty']*$row['price'].'EGP</td>
            </tr>');
        }
    }
}

    

   
