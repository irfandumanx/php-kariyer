<?php

namespace Controllers;

use RouteDTO;

class BaseController
{
    public RouteDTO $routeDTO;
    public string $err = "";

    protected function isGet(): bool
    {
        return $this->routeDTO->method === "GET";
    }

    protected function isPost(): bool
    {
        return $this->routeDTO->method === "POST";
    }

}