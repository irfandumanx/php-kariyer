<?php

namespace Requests\RequestsValidations;

class MinLenValidation extends AbstractHandler
{

    public function handle($fieldName, $data): ?string
    {
        if (is_string($data) && strlen($data) < $this->options[0])
            return "$fieldName metini {$this->options[0]}'den daha kısa olamaz.";
        return parent::handle($fieldName, $data);
    }

}