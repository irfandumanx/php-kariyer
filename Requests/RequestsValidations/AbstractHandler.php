<?php

namespace Requests\RequestsValidations;

abstract class AbstractHandler implements Handler
{
    private $nextHandler = null;
    public array $options;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle($fieldName, $data): ?string
    {
        return $this->nextHandler?->handle($fieldName, $data);
    }

    public function getNextHandler()
    {
        return $this->nextHandler;
    }

}