<?php 
require_once "ViewAbst.php";
require_once "../Model/ProgramModel.php";
require_once "../Model/ItemModel.php";

class CartView extends ViewAbst {
    function ShowCart(){
        $total=0;
        echo('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../CSS/CRUD.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                    <title>My Cart</title>
            </head>
            <body>
            <header>
                    <h1>My Cart</h1>
                    <nav>
                        <ul>
                            <li><a class="kk" href="..\Controller\HomeController.php">Home</a></li>
                        </ul>
                    </nav>
            </header>');
        if(empty($_SESSION['cart']))
            echo('<div class="message">cart is empty</div>');
        else{
            echo('
            <div class="container">
            
            <div class="object-display">
                    <table class="object-display-table">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Program Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
            ');
            foreach ($_SESSION['cart'] as $item => $quantity) {
                $itemModel = new ItemModel();
                $programModel = new ProgramModel();
                $itemModel->getById($item);
                $programModel->getById($itemModel->getProgramID());
                $total+=$quantity*$itemModel->getCost();
                echo ('
                <tr>
                    <td>'.$itemModel->getItemName().'</td>
                    <td>'.$programModel->getProgramName().'</td>
                    <td>'.$quantity.'</td>
                    <td>$'.$itemModel->getCost().'</td>
                    <td>$'.$quantity*$itemModel->getCost().'</td>
                    <td><a href="CartController.php?cmd=removeitem&item='.$item.'" class="btn">Remove</a></td>    
                </tr>');
            }
            echo ('
            <table class="object-display-table">
                <tr>
                    <td><a href="HomeController.php?" class="btn"> Back to Home </a></td>
                    <td><a href="CartController.php?cmd=removeall" class="btn"> Remove All </a></td>
               
                  
                    
                </tr>
                <div class="message">Grand Total: '.$total.'</div>
            </table>

            <form action="..\Controller\PaymentController.php?cmd=paymentoptions" method="post">
                <br><label style="font-size: 20px">Increase My Impact</label>
                <p style="font-size: 14px">
                <input type="checkbox" id="tr_add" name="tr_add">
                Add 5EGP to help cover our transaction fees.<br>
                <input type="checkbox" id="other_add" name="other_add">
                Add 10EGP to help cover other fees associated with the donation.</p>
                <input type="hidden" id="cost" name="cost" value="'.$total.'">
                <button class="btn" type="submit" value="pay" >Proceed to Payment</button>
            </form>
            ');

        }    
    }
}