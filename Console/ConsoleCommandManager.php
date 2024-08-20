<?php

namespace Console;

class ConsoleCommandManager
{

    private array $commands = [];
    public function __construct(public array $args)
    {
        $this->bind();
    }

    public function getCommand(string $command): ?Command {
        foreach ($this->commands as $command_) {
            if (in_array(strtolower($command), $command_->getCommands()))
                return $command_;
        }
        return null;
    }

    private function bind(): void
    {
        $files = scandir(__DIR__. "/Commands");
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $file = pathinfo($file, PATHINFO_FILENAME);
            $cls = "Console\\Commands\\$file";
            $command = new $cls();
            $command->args = $this->args;
            $this->commands[] = $command;
        }
    }

}