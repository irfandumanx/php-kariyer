<?php

namespace Console;

interface Command
{

    function apply(): void;
    function getCommands(): array;

}