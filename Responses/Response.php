<?php

namespace Responses;
abstract class Response
{

    public function __construct(protected string|int $statusCode)
    {
    }

    abstract protected function response(array $data);

}