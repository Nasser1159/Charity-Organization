<?php

require_once "../View/ViewAbst.php";

class PaymentView extends ViewAbst{
    function ShowPaymentOptions($cost){
        session_start();
        echo('<!DOCTYPE html>
        <html lang="en"><head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                            <li><a href="..\Controller\CartController.php?cmd=showcart" class="kk">Cart</a></li>
                        </ul>
                    </nav>
                </header>
                
                <main>
                    <h1>Payment</h1><br><br>
                    <h2>Total cost :'.$cost.' EGP<h2>
                    <form action="PaymentController.php?cmd=result" method="post">
                    <input type="hidden" name="cost" value="' .$cost.'"> 
                    <label for="item"> Choose Payment Method </label>
                    <select name = "paymentmethod">');
      
            echo(' <option value="Fawry">Fawry</option>
                 <option value="Visa">Visa</option>');
                   
              echo('     
                </select> <hr>
                <input type="submit" value="Pay Now" >
                </form>
                <p class="Cancel-link"><a href="..\Controller\HomeController.php">Cancel</a></p>
                </main>
                <footer>
                    <p>© 2024 Food Bank</p>
                </footer>
            </body>
        </html>');
    }

    function PaymentResult($result, $paymentMethod,$total) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../CSS/CRUD.css">
            <title>Food Bank</title>
        </head>
        <body>
        <header>
        <h1>Food Bank</h1>
        <nav>
            <ul>
                <li><a class="kk" href="HomeController.php">Home</a></li>
            </ul>
        </nav>
</header>';

        $this->PrintMessage($result, $paymentMethod);

        echo '<form action="DonationController.php?cmd=add" method="post">
            <input type="hidden" name="cost" value="'.$total.'"> 
            <input class="btn" type="submit" id="receipt" value="Show Receipt">
        </form>
        </body>
        </html>';
        $this->PrintFooter();
    }

}
?>