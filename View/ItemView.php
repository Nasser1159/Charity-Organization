<?php

require_once "../View/ViewAbst.php";
require_once "../Model/ProgramModel.php";

class ItemView extends ViewAbst{

    function ShowItemsTable($rows){
        echo (' 
        <!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/CRUD.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Item CRUD</title>
</head>
<body>
<header>
        <h1>Item Database</h1>
        <nav>
            <ul>
                <li><a class="kk" href="../View/dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
</header>
<div class="container">

   <div class="admin-object-form-container">

      <form  action="../Controller/ItemController.php?cmd=add" method="post">
         <h3>add a new item</h3>
         <input type="text" placeholder="enter item name" name="item_name" class="box" required>
         <input type="number" placeholder="enter item amount" min="0" name="amount" class="box" required>
         <input type="number" step="0.001" min="0" max="9999" placeholder="enter item cost" name="item_cost" class="box" required>
         <input type="number" placeholder="enter program id" name="program_id" class="box" required>
         <input type="submit" class="btn" name="add_item" value="Create">
      </form>

   </div>

   <div class="object-display">
      <table class="object-display-table">
         <thead>
         <tr>
            <th>#</th>
            <th>program name</th>
            <th>item name</th>
            <th>item cost</th>
            <th>item amount</th>
            <th></th>
         </tr>
         </thead>');

         
         foreach($rows as $row)               // should we display program name too to be more readable?
         echo('<tr>
         <td>'.$row['id'].'</td>
         <td>'.$row['program_name'].'</td>
         <td>'.$row['item_name'].'</td>
         <td>'.$row['item_cost']."EGP".'</td>
         <td>'.$row['amount'].'</td>
         <td>
         <a href="ItemController.php?cmd=edit&id='.md5($row['id']).'" class="btn"> Edit </a> 
         <a href="ItemController.php?cmd=delete&id='.md5($row['id']).'" class="btn"> Delete </a>
         </td>
     </tr>');
   }
       
    function ChangeItem($succ) {
        echo('<html lang="en"><head>
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
                        <li><a class="kk" href="ItemController.php?cmd=viewAll">Return</a></li>
                    </ul>
                </nav>
        </header>');
        $this->PrintMessage($succ);
    }
   

   function EditItem($obj){
    echo(' <!DOCTYPE html>
    <html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="../CSS/CRUD.css">
    </head>
    <body>
    
    <style> body{background-color: #2024a5;}</style>
    
    <div class="container">
    
    
    <div class="admin-object-form-container centered">
       <form  method="post">
          <h3 class="title">Edit the item</h3>
          <input type="text" class="box" name="item_name" value="'.$obj->getItemName().'" placeholder="enter item name">
          <input type="number" min="0" class="box" name="amount" value="'.$obj->getAmount().'" placeholder="enter amount">
          <input type="number" class="box" step="0.001" name="item_cost" value="'.$obj->getCost().'" placeholder="enter cost">
          <input type="number" class="box" name="program_id" value="'.ProgramModel::getByHash($obj->getProgramID()).'" placeholder="enter program id">
          <input type="submit" value="Update" name="update_item" class="btn">
          <a href="../Controller/ItemController.php?cmd=viewAll" class="btn">Cancel</a>
       </form>
    </div>
    
    </div>
    
    </body>
    </html>');

   }
   function deleteRow() {
    echo('
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>View Record</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="..\CSS\CRUD.css">
            <style type="text/css">
                .wrapper{
                    width: 500px;
                    margin: 0 auto;
                }
            </style>
        </head>
        <body>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h1>Delete Record</h1>
                            </div>
                            <form action="../Controller/ItemController.php?cmd=delete" method="post">
                                <div>
                                    <input type="hidden" name="id" value="'.trim($_GET["id"]).'"/>
                                    <p>Are you sure you want to delete this record?</p><br>
                                    <p>
                                        <input type="submit" value="Yes" class="btn">
                                        <a href="../Controller/ItemController.php?cmd=viewAll" class="btn">No</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div>
        </body>
    </html>
    ');
}
    
}
?>
