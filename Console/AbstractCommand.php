<?php

namespace Console;

abstract class AbstractCommand implements Command
{
    public array $args = [];

    protected function isIn(string $arg): bool
    {
        return in_array($arg, $this->args);
    }

}