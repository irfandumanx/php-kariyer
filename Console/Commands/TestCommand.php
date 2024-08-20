<?php

namespace Console\Commands;

use Console\AbstractCommand;
use GearmanClient;
use GearmanWorker;

class TestCommand extends AbstractCommand
{
//tarayıcı ile uğraşmamak için direkt görmek istediğim sonuçları cmdden elde ediyorum

    function apply(): void
    {
        $gmc= new GearmanClient();

        $gmc->addServer();

        $gmc->setCompleteCallback("reverse_complete");
        $gmc->setStatusCallback("reverse_status");

        $task= $gmc->addTaskBackground("reverse", "!dlroW olleH", null, "2");
        $task= $gmc->addTaskBackground("reverse", "Hello world!", null, "2");

        $gmc->runTasks();
        echoGreen("çalışıyom");
    }

    function getCommands(): array
    {
        return ["test", "t"];
    }
}