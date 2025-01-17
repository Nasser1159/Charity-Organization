<?php
require_once "ViewAbst.php";
require_once "../Model/DonationModel.php";
require_once "../Model/ProgramModel.php";
require_once "../Model/ItemModel.php";
require_once "../Model/DonorModel.php";

class DonationDetailsView extends ViewAbst {
    function ShowDonationDetailsTable($rows) {
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
                        <th>#</th>
                        <th>Item ID</th>
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
            $donationId = isset($row['donation_id']) ? $row['donation_id'] : '9';
            $qty = isset($row['Qty']) ? $row['Qty'] : 0;
            if (DonationModel::getByHash($donationId) != null) {
                $j = DonationModel::getByHash($donationId);
            } else { 
                $j = '999';
            }
            echo('
            <tr>
                <td>'.$j.'</td>
                <td>'.ItemModel::getByHash($row['item_id']).'</td>
                <td>'.$itemModel->getItemName().'</td>
                <td>'.$programModel->getProgramName().'</td>
                <td>'.$qty.'</td>
                <td>'.$row['price'].'EGP</td>
                <td>'.$qty*$row['price'].'EGP</td>
            </tr>');
        }
    }

    function ShowReciept($donation_id, $rows,$total) {
        $donation = new DonationModel();
        $donation->getById($donation_id);
        echo('
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="..\CSS\CRUD.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
            <title>Reciept</title>
        </head>
        <body>
            <header>
                <h1>Food Bank</h1>
            </header>
            <div class="container">
            <h2>Donor ID: '.DonorModel::getByHash($donation->getDonorId()).'</h2><br/>
            <h2>Total Cost: '.$donation->getTotalCost().'EGP</h2></br>
            <h2>Donation Date: '.$donation->getDonationDate().'</h2><br/>
        ');
        echo('
            <div class="object-display">
                <table class="object-display-table">
                    <thead><tr>
                    <th>Id</th>
                    <th>Item Id</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    </tr></thead>');
        foreach($rows as $row) {
            echo ('
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.ItemModel::getByHash($row['item_id']).'</td>
                <td>'.$row['Qty'].'</td>
                <td>'.$row['price'] * $row['Qty'].'EGP</td>
            </tr>
        ');
        }
        echo('
                </table>
            </div>
            <h2><a href="../Controller/HomeController.php">Return Home</a><h2/>
            </div>
        </body>
        </html>
        ');
    }
}