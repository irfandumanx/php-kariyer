<?php

namespace Responses;

use Reflections;

class JsonResponse extends Response
{
    public function __construct(private array|object $data, $statusCode = 200)
    {
        parent::__construct($statusCode);
        if (is_object($data)) $this->data = Reflections::toArray($data);
        $this->response($this->data);
    }

    protected function response(array $data): void
    {
        http_response_code(is_numeric($this->statusCode) ? $this->statusCode : 200);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}