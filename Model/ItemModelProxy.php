<?php
require_once "IItemModel.php";

class ItemModelProxy implements IItemModel {
    private ?ItemModel $realItemModel = null;
    private array $cache = [];

    public function __construct(private int $id = 0) {}

    private function getRealItemModel(): ItemModel {
        if ($this->realItemModel === null) {
            $this->realItemModel = new ItemModel();
            $this->realItemModel->setId($this->id);
        }
        return $this->realItemModel;
    }

    public function add() {
        $this->invalidateCache();
        return $this->getRealItemModel()->add();
    }

    public function edit() {
        $this->invalidateCache();
        return $this->getRealItemModel()->edit();
    }

    public function read() {
        if (isset($this->cache['read'])) {
            return $this->cache['read'];
        }
        $this->cache['read'] = $this->getRealItemModel()->read();
        return $this->cache['read'];
    }

    public static function remove($id) {
        self::invalidateCache();        
        return ItemModel::remove($id);
    }
    

    public static function view_all() {
        if (isset($cache['view_all'])) {
            return $cache['view_all'];
        }    
        $cache['view_all'] = ItemModel::view_all();
        return $cache['view_all'];
    }
    

    private function invalidateCache() {
        $this->cache = [];
    }
}
?>
