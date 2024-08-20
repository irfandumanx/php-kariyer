<?php

namespace Requests\RequestsValidations;

class GreaterThanValidation extends AbstractHandler
{
    public function handle($fieldName, $data): ?string
    {
        if (is_numeric($data) && $data < $this->options[0])
            return "$fieldName must be greater than {$this->options[0]}";
         else
            return parent::handle($fieldName, $data);
    }
}