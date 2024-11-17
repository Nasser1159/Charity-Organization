<?php 
require_once "ViewAbst.php";
require_once "../Model/ProgramModel.php";
require_once "../Model/ItemModel.php";

class HomeView extends ViewAbst {
    function ShowHome($logged, $rows, $username = null) {
        echo('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="..\CSS\CRUD.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
            <title>Food Bank</title>
        </head>
        <body>
            <header>
                <h1>Food Bank</h1>
                <nav>
                    <ul>'
        );
        if ($logged) {
            echo('<li><a class="kk" href="..\Controller\DonorController.php?id='.md5( $_SESSION['user_id']).'&cmd=myacc">My Account</a></li>');

            echo('<li><a class="kk" href="..\Controller\HomeController.php?cmd=logout">Logout</a></li>');
            echo('<li><a class="kk" href="..\Controller\CartController.php?cmd=showcart">Cart</a></li>');
        }
        else {
            echo('<li><a class="kk" href="..\Controller\HomeController.php?cmd=login">Login</a></li>');
            echo('<li><a class="kk" href="..\View\dashboard.php">Dashboard</a></li>');
        }
        echo('
                  </ul>
                </nav>
            </header>
            <div class="container">');
        if ($logged) {
            echo('<h1>Welcome User: '.$username.'</h1><br/>');
        }
        echo('
            <div class="object-display">
                <table class="object-display-table">
                    <thead><tr>
                    <th>Program Name</th>
                    <th>Description</th>'
            );
        if ($logged)
            echo('<th>Action</th>');  
        echo('</tr></thead>');
        foreach($rows as $row) {
            echo ('
            <tr>
                <td>'.$row['program_name'].'</td>
                <td>'.$row['description'].'</td>
            ');
            if ($logged)
                echo('<td><a href="ProgramController.php?cmd=showtouser&id='.md5($row['id']).'">Donate</a></td>'); 
            echo("</tr>");
        }
    }

    function ShowLogin($error){
        echo('
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="..\CSS\login.css">
                <title>Login</title>
            </head>
            <body>
                <section class="container">
                    <header><h1>Login</h1></header>');
                    if ($error != null)
                        echo('<p style="color: red;">'.$error.'</p>');
                    echo('
                            <form action="..\Controller\HomeController.php" method="POST" class="form">
                            <div class = "input-box">
                                <label>Username:</label>
                                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                            </div>
        
                            <div class = "input-box">
                                <label>Password:</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            </div>
        
                            <button>Submit</button>
                        <p class="login-link">First Time?
                        <a href="..\Controller\DonorController.php?cmd=signup&id=">Sign Up</a>
                        <a href="..\Controller\HomeController.php">Cancel</a></p>
                        </form>
                </section>
            </body>
        </html>
        ');
    }
}
