<?php
interface IItemModel {
    public function add();
    public function edit();
    public function read();
    public static function remove($id);
    public static function view_all();
}
?>
