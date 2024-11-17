<?php
require_once "ViewAbst.php";
require_once  "../Model/ProgramModel.php";

class ProgramView extends ViewAbst {
    function ShowProgramsTable($rows) {
        
        echo('<!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="..\CSS\CRUD.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
                    <title>Program CRUD</title>
            </head>
            <body>
            <header>
                    <h1>Program Database</h1>
                    <nav>
                        <ul>
                            <li><a class="kk" href="..\View\dashboard.php">Dashboard</a></li>
                        </ul>
                    </nav>
            </header>
            <div class="container">

            <div class="admin-object-form-container">

                <form action="ProgramController.php?cmd=add" method="post">
                    <h3>add a new Program</h3>
                    <input type="text" placeholder="enter Program name" name="name" class="box" required>
                    <input type="text" placeholder="enter Program address" name="address" class="box" required>
                    <input type="hidden" name="cmd" value="add">
                    <input type="submit" class="btn" name="add_Program" value="Create">
                </form>

            </div>

            <div class="object-display">
                <table class="object-display-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Program name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>');
            foreach ($rows as $row) {
                echo('
                    <tr><td>'.$row['id'].'</td>
                    <td>'.$row['program_name'].'</td>
                    <td>'.$row['description'].'</td>
                    <td>
                    <a href="ProgramController.php?cmd=edit&id='.md5($row['id']).'" class="btn"> Edit </a>
                    <a href="ProgramController.php?cmd=delete&id='.md5($row['id']).'" class="btn"> Delete </a>
                    </td></tr>
                ');
            }
    }

    function ChangeProgram($succ) {
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
                        <li><a class="kk" href="ProgramController.php?cmd=viewAll">Return</a></li>
                    </ul>
                </nav>
        </header>');
        $this->PrintMessage($succ);
    }

    function EditProgram($obj) {
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
                <h3 class="title">Edit the Program</h3>
                <input type="text" class="box" name="name" value="'.$obj->getProgramName().'" placeholder="enter the Program name" required>
                <input type="text" min="0" class="box" name="address" value="'.$obj->getProgramDescription().'" placeholder="enter the Program address" required>
                <input type="submit" value="Update" name="update_Program" class="btn">
                <a href="ProgramController.php?cmd=viewAll" class="btn">Cancel</a>
            </form>
            </div>
            
            </div>
            
            </body>
        </html>');
    }

    function ShowProgramToUser($program,$stmt){
        session_start();
        echo('<html lang="en"><head>
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
                            <li><a class="kk" href="..\Controller\HomeController.php">Home</a></li>
                            <li><a class="kk" href="..\Controller\DonorController.php?id='. md5($_SESSION['user_id']).'&cmd=myacc">My Account</a></li>
                            <li><a class="kk" href="..\Controller\CartController.php?cmd=showcart">Cart</a></li>
                        </ul>
                    </nav>
                </header>
                
                <main>
                    <h1>'.$program->getProgramName().'</h1><br><br>
                    <h2>'.$program->getProgramDescription().'<h2>
                    <form action="CartController.php?cmd=addToCart&id='.$_GET['id'].'" method="post">
                    <label for="item"> Choose item: </label>
                    <select name = "item">');
        foreach($stmt as $row){
            $ItemModel = new ItemModel();
            $ItemModel->setId(md5($row['id']));  
            $ItemModel->getById(md5($row['id']));
           
            echo('<option value="'.$ItemModel->getId().'">'.$ItemModel->getItemName().'</option>');
        }            
              echo('     
                </select> 
                <label></label>
                <label>Amount: </label>
                <input type="number" id="quantity" min="0" max="100" name="quantity" value=0 required> 
                <br><br>
                <input type="hidden" name="program_name" value="'.$program->getProgramName().'">
                <input type="hidden" name="program_id" value="'.md5($program->getId()).'">
                <input type="submit" value="Add to Cart">
                </form>
                <p class="Cancel-link"><a href="..\Controller\HomeController.php">Cancel</a></p>
                </main>
                <footer>
                    <p>© 2024 Food Bank</p>
                </footer>
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
                                <form action="../Controller/ProgramController.php?cmd=delete" method="post">
                                    <div>
                                        <input type="hidden" name="id" value="'.trim($_GET["id"]).'"/>
                                        <p>Are you sure you want to delete this record?</p><br>
                                        <p>
                                            <input type="submit" value="Yes" class="btn">
                                            <a href="../Controller/ProgramController.php?cmd=viewAll" class="btn">No</a>
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
