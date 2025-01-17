<?php
require_once "../Model/ItemModelProxy.php";
require_once "../View/ItemView.php";
require_once "../Model/ProgramModel.php";

class ItemController {
    public $itemView;

    public function __construct() {
        $this->itemView = new ItemView();
    }

    public function addController() {
        $program = new ProgramModel();
        $program->getnamefromid($_POST['program_id']);

        $itemProxy = new ItemModelProxy();
        $itemModel = $itemProxy->getRealItemModel();
        $itemModel->setProgramID(md5(trim($_POST['program_id'])));
        $itemModel->setItemName(trim($_POST['item_name']));
        $itemModel->setCost(trim($_POST['item_cost']));
        $itemModel->setAmount(trim($_POST['amount']));
        $itemModel->setProgramName($program->getProgramName());

        try {
            $this->itemView->ChangeItem($itemProxy->add());
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $this->itemView->ChangeItem(0);
            }
        }
    }

    public function deleteController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->itemView->ChangeItem(ItemModelProxy::remove($_POST['id']));
        } else {
            $this->itemView->deleteRow();
        }
    }

    public function view_allController() {
        $itemProxy = new ItemModelProxy();
        $stmt = $itemProxy::view_all();
        $this->itemView->ShowItemsTable($stmt);
    }

    public function editController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $program = new ProgramModel();
            $program->getnamefromid($_POST['program_id']);

            $itemProxy = new ItemModelProxy();
            $itemModel = $itemProxy->getRealItemModel();
            $itemModel->setProgramID(md5(trim($_POST['program_id'])));
            $itemModel->setItemName(trim($_POST['item_name']));
            $itemModel->setCost(trim($_POST['item_cost']));
            $itemModel->setAmount(trim($_POST['amount']));
            $itemModel->setProgramName($program->getProgramName());
            $itemModel->setId($_GET['id']);

            try{
            $this->itemView->ChangeItem($itemProxy->edit()); 
                }catch(PDOException $e){
                    if ($e->getCode() == '23000') {
                        $this->itemView->ChangeItem(0);
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
} elseif ($command == 'edit') {
    $controller->editController();
} elseif ($command == 'add' && $_GET['cmd'] == $command) {
    $controller->addController();
} elseif ($command == 'delete') {
    $controller->deleteController();
}

$controller->itemView->PrintFooter();
