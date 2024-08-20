<?php

namespace Requests\RequestsValidations;

class RequiredValidation extends AbstractHandler
{

    public function handle($fieldName, $data): ?string
    {
        if (!isset($data) || (is_string($data) && empty($data))) {
            return "$fieldName boş gönderilemez.";
        } else {
            return parent::handle($fieldName, $data);
        }
    }

}