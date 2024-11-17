<?php
require_once "ViewAbst.php";

class SupplierView extends ViewAbst {
    function ShowSuppliersTable($rows) {
        
        echo('<!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="..\CSS\CRUD.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                    <title>Supplier CRUD</title>
            </head>
            <body>
            <header>
                    <h1>Supplier Database</h1>
                    <nav>
                        <ul>
                            <li><a class="kk" href="..\View\dashboard.php">Dashboard</a></li>
                        </ul>
                    </nav>
            </header>
            <div class="container">

            <div class="admin-object-form-container">

                <form action="SupplierController.php?cmd=add" method="post">
                    <h3>add a new Supplier</h3>
                    <input type="text" placeholder="enter Supplier name" name="name" class="box" required>
                    <input type="text" placeholder="enter Supplier address" name="address" class="box" required>
                    <input type="hidden" name="cmd" value="add">
                    <input type="submit" class="btn" name="add_Supplier" value="Create">
                </form>

            </div>

            <div class="object-display">
                <table class="object-display-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier name</th>
                        <th>Supplier address</th>
                        <th></th>
                    </tr>
                    </thead>');
        foreach ($rows as $row) {
            echo('
                <tr><td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['address'].'</td>
                <td>
                <a href="SupplierController.php?cmd=edit&id='.md5($row['id']).'" class="btn"> Edit </a>
                <a href="SupplierController.php?cmd=delete&id='.md5($row['id']).'" class="btn">Delete </a>
                </td></tr>
            ');
        }
    }

    function ChangeSupplier($succ) {
        echo('<html lang="en"><head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="..\CSS\CRUD.css">
            <title>Food Bank</title>
        </head>
        <body>
            <header>
                <h1>Food Bank</h1>
                <nav>
                    <ul>
                        <li><a class="kk" href="SupplierController.php?cmd=viewAll">Return</a></li>
                    </ul>
                </nav>
        </header>');
        $this->PrintMessage($succ);
    }

    function EditSupplier($obj) {
        echo('<!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="..\CSS\CRUD.css">
            </head>
            <body>
            
            <style> body{background-color: #2024a5;}</style>
            
            <div class="container">
            
            
            <div class="admin-object-form-container centered">
            <form method="post">
                <h3 class="title">Edit the Supplier</h3>
                <input type="text" class="box" name="name" value="'.$obj->getName().'" placeholder="enter the Supplier name" required>
                <input type="text" min="0" class="box" name="address" value="'.$obj->getAddress().'" placeholder="enter the Supplier address" required>
                <input type="submit" value="Update" name="update_Supplier" class="btn">
                <a href="SupplierController.php?cmd=viewAll" class="btn">Cancel</a>
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
                                <form action="../Controller/SupplierController.php?cmd=delete" method="post">
                                    <div>
                                        <input type="hidden" name="id" value="'.trim($_GET["id"]).'"/>
                                        <p>Are you sure you want to delete this record?</p><br>
                                        <p>
                                            <input type="submit" value="Yes" class="btn">
                                            <a href="../Controller/SupplierController.php?cmd=viewAll" class="btn">No</a>
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