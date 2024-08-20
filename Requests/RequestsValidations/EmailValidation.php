<?php

namespace Requests\RequestsValidations;

class EmailValidation extends AbstractHandler
{

    public function handle($fieldName, $data): ?string
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "$fieldName is not a valid email address";
        }
        return parent::handle($fieldName, $data);
    }

}