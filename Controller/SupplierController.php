<?php
require_once "../Model/SupplierModel.php";
require_once "../View/SupplierView.php";

class SupplierController {
    public $suppView;
    function __construct() {
        $this->suppView = new SupplierView();
    }
    public function addController() {
        $suppModel = new SupplierModel(trim($_POST['name']), trim($_POST['address']));
        $this->suppView->ChangeSupplier($suppModel->add());
    }
    public function deleteController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->suppView->ChangeSupplier(SupplierModel::remove($_POST['id']));        
        }
        else $this->suppView->deleteRow();
    }
    public function view_allController() {
        $stmt = SupplierModel::view_all();
        $this->suppView->ShowSuppliersTable($stmt);
    }

    public function editController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $suppModel = new SupplierModel(trim($_POST['name']), trim($_POST['address']));
            $suppModel->setId($_GET['id']);
            $this->suppView->ChangeSupplier($suppModel->edit());
        }
        else {
            $suppModel = new SupplierModel();
            $suppModel->getById($_GET['id']);
            $this->suppView->EditSupplier($suppModel);
        }
    }
}

$controller = new SupplierController();
$command = $_GET['cmd'];

if ($command == 'viewAll') {
    $controller->view_allController();
}

else if ($command == 'edit') {
    $controller->editController();
}

else if ($command == 'add' && $_POST['cmd'] == $command) {
    $controller->addController();
}

else if ($command == 'delete')
    $controller->deleteController();

$controller->suppView->PrintFooter();
