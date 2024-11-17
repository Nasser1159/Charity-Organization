<?php
require_once "../Model/ItemModel.php";
require_once "../View/ItemView.php";
require_once "../Model/ProgramModel.php";

class ItemController {
    public $itemView;
    function __construct() {
        $this->itemView = new ItemView();
    }
    public function addController() {
        $program = new ProgramModel();
        $program->getnamefromid($_POST['program_id']);
        $itemModel = new ItemModel(md5(trim($_POST['program_id'])), trim($_POST['item_name']), trim($_POST['item_cost']), trim($_POST['amount']), $program->getProgramName(), 0, $program);
        try{
        $this->itemView->ChangeItem($itemModel->add()); 
            }catch(PDOException $e){
                if ($e->getCode() == '23000') {
                    $this->itemView->ChangeItem(0);
                } else {
                    echo "Error: " . $e->getMessage();
                }
            }
    }
    public function deleteController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->itemView->ChangeItem(ItemModel::remove($_POST['id']));    
        }
        else $this->itemView->deleteRow();
    }
    public function view_allController() {
        $stmt = ItemModel::view_all();
        $this->itemView->ShowItemsTable($stmt);
}

    public function editController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $program = new ProgramModel();
            $program->getnamefromid($_POST['program_id']);
            $itemModel = new ItemModel(md5(trim($_POST['program_id'])), trim($_POST['item_name']), trim($_POST['item_cost']), trim($_POST['amount']), $program->getProgramName());
            $itemModel->setId($_GET['id']);
            try{
            $this->itemView->ChangeItem($itemModel->edit()); 
                }catch(PDOException $e){
                    if ($e->getCode() == '23000') {
                        $this->itemView->ChangeItem(0);
                    } else {
                        echo "Error: " . $e->getMessage();
                    }
                }

        }
        else{
            $itemModel = new ItemModel();
            $itemModel->getById($_GET['id']);
            $this->itemView->EditItem($itemModel);
        }
    }
}

$controller = new ItemController();


$command = $_GET['cmd'];
$itemView = new ItemView();  

if ($command == 'viewAll') {
    $controller->view_allController();
}

else if ($command == 'edit' ) {
    $controller->editController();
}

else if ($command == 'add' && $_GET['cmd'] == $command) {
    $controller->addController();
}

else if ($command == 'delete')
    $controller->deleteController();

$controller->itemView->PrintFooter();
