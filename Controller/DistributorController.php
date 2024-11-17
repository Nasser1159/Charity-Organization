<?php
require_once "../Model/DistributorModel.php";
require_once "../View/DistributorView.php";

class DistributorController {
    public $distView;
    function __construct() {
        $this->distView = new DistributorView();
    }
    public function addController() {
        $distModel = new DistributorModel(trim($_POST['name']), trim($_POST['address']));
        $this->distView->ChangeDistributor($distModel->add());
}
    public function deleteController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->distView->ChangeDistributor(DistributorModel::remove($_POST['id']));
        }
        else $this->distView->deleteRow();
}
    public function view_allController() {
        $stmt = DistributorModel::view_all();
        $this->distView->ShowDistributorsTable($stmt);
}

    public function editController() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $distModel = new DistributorModel(trim($_POST['name']), trim($_POST['address']));
            $distModel->setId($_GET['id']);
            $this->distView->ChangeDistributor($distModel->edit());
        }
        else {
            $distModel = new DistributorModel();
            $distModel->getById($_GET['id']);
            $this->distView->EditDistributor($distModel);
        }
    }
}

$controller = new DistributorController();


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

$controller->distView->PrintFooter();