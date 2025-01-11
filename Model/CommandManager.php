<?php

class CommandManager {
    private $commandStack = [];

    public function __construct() {
        if (isset($_SESSION['commandStack'])) {
            $this->commandStack = $_SESSION['commandStack'];
        }
    }

    public function executeCommand(CartCommand $command) {
        $command->execute();
        $this->commandStack[] = $command;
        $_SESSION['commandStack'] = $this->commandStack;
    }

    public function undoCommand() {
        if (!empty($this->commandStack)) {
            $lastCommand = array_pop($this->commandStack);
            $lastCommand->undo();

            $_SESSION['commandStack'] = $this->commandStack;

            error_log("Undo called. Stack size after undo: " . count($this->commandStack));
        } else {
            error_log("Undo called but no commands to undo.");
        }
    }
}

