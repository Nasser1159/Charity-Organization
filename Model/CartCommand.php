<?php

interface CartCommand {
    public function execute();
    public function undo();
}
