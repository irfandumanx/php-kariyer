<?php

namespace Requests;
class Request
{
    private array $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function getData(): array
    {
        return $this->data;
    }

}