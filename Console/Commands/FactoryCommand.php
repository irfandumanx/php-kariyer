<?php

namespace Console\Commands;

use Console\AbstractCommand;
use Factories\FactoryBooter;

class FactoryCommand extends AbstractCommand
{

    function apply(): void
    {
        if ($this->isIn("-n") || $this->isIn("-name")) {
            $className = "Factories\\{$this->args[1]}";
            if (file_exists(str_replace("\\", "/", $className).".php")) {
                $inst = new $className;
                $inst->run();
            } else echoRed("Dosya bulunamadı.");
            return;
        }

        $booter = new FactoryBooter();
        foreach ($booter->booters() as $factoryStr) {
            $factoryInstance = new $factoryStr;
            $factoryInstance->run();
        }
    }

    function getCommands(): array
    {
        return ["factory", "fact"];
    }
}