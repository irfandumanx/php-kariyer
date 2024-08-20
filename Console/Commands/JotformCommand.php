<?php

namespace Console\Commands;

use Console\AbstractCommand;
use Console\Command;

class JotformCommand extends AbstractCommand
{

    function apply(): void
    {
        if ($this->isIn("-hi") || $this->isIn("-hello")) echoNormal("HELLO EVERYONE FROM JOTFORM!!");
        if ($this->isIn("-ovuncbey")) echoGreen("övünç abi kraldır");
    }

    function getCommands(): array
    {
        return ["form", "jotform", "jot"];
    }
}