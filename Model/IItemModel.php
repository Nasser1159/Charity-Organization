<?php
interface IItemModel {
    public function add();
    public function edit();
    public function read();
    public function remove($id);
    public function view_all();
}
?>