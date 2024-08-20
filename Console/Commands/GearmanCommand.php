<?php

namespace Console\Commands;

use Console\AbstractCommand;
use GearmanWorker;

class GearmanCommand extends AbstractCommand
{
    function apply(): void
    {
        $gmWorker = new GearmanWorker();

        $gmWorker->addServer();
        $gmWorker->addFunction("gearmanFunction", "phpFunction");

        print "Waiting for job...\n";
        while($gmWorker->work())
        {
            if ($gmWorker->returnCode() != GEARMAN_SUCCESS)
            {
                echo "return_code: " . $gmWorker->returnCode() . "\n";
                break;
            }
        }
    }

    function getCommands(): array
    {
        return ["gearman", "gear", "gm"];
    }
}