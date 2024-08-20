<?php

namespace Requests\RequestsValidations;

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle($fieldName, $data): ?string;
}