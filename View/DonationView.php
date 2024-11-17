<?php
require_once "ViewAbst.php";
require_once  "../Model/DonorModel.php";

class DonationsView extends ViewAbst{
    function ShowDonationsTable($rows) {
        $donorModel = new DonorModel();
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
                        <li><a href="../View/dashboard.php" class="kk">Dashboard</a></li>
                        <li><a href="../Controller/DonorController.php?cmd=viewAll&id=" class="kk">Donors</a></li>
                    </ul>
                </nav>
        </header>
        <div class="container">
        
           <div class="object-display">
                <table class="object-display-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Donor Name</th>
                        <th>Amount Donated</th>
                        <th>Donation Date</th>
                        <th></th>
                    </tr>
                    </thead>
        ');
        
        foreach($rows as $row) {
            $donorModel->getById($row['donor_id']);
            echo('
            <tr>
                <td>'. $row['id'].'</td>
                <td>'.$donorModel->getUserName().'</td>
                <td>'. $row['total_cost'].'EGP</td>
                <td>'. $row['donation_date'].'</td>
                <td>
                <a href="DonationDetailsController.php?cmd=viewDetails&id='.md5($row['id']).'" class="btn"> Details </a>
            </td>
            </tr>');
        }
    }
}