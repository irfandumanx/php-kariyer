<?php

namespace Console\Commands;

use Console\AbstractCommand;

class ServeCommand extends AbstractCommand
{
    function apply(): void
    {
        $command = 'php -S localhost:8000';
        $handle = popen($command, 'r');

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                echo $line;
            }
            pclose($handle);
        }
    }

    function getCommands(): array
    {
        return ["serve", "serv"];
    }
}